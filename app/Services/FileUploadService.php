<?php

namespace App\Services;

use App\Models\Resource;
use App\Models\SiteSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FileUploadService
{
    protected array $blacklistedExtensions = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'phps', 'phar',
        'exe', 'com', 'bat', 'cmd', 'sh', 'bash', 'bin', 'cgi',
        'pl', 'py', 'js', 'vbs', 'jar', 'msi', 'dll', 'asp', 'aspx',
    ];

    public function upload(UploadedFile $file): array
    {
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        
        // 1. Strict extension check against blacklisted executables
        if (in_array($extension, $this->blacklistedExtensions)) {
            throw ValidationException::withMessages([
                'file' => 'Execution files and scripts are strictly prohibited for security reasons.',
            ]);
        }

        // 2. Check allowed extensions from settings
        $allowedSetting = SiteSetting::get('allowed_extensions', 'pdf,docx,pptx,xlsx,jpg,png');
        $allowedList = array_map('trim', explode(',', strtolower($allowedSetting)));
        if (!in_array($extension, $allowedList)) {
            throw ValidationException::withMessages([
                'file' => "File format .{$extension} is not supported. Allowed formats: " . implode(', ', $allowedList),
            ]);
        }

        // 3. Size validation
        $maxMb = (int) SiteSetting::get('max_upload_size', 10);
        $fileSizeBytes = $file->getSize();
        if ($fileSizeBytes > ($maxMb * 1024 * 1024)) {
            throw ValidationException::withMessages([
                'file' => "The uploaded file exceeds the maximum allowed size of {$maxMb} MB.",
            ]);
        }

        // 4. MIME sniffing using PHP finfo (never trust client headers)
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($file->getRealPath());

        // 5. Calculate SHA256 hash
        $fileHash = hash_file('sha256', $file->getRealPath());

        // Check for exact duplicate approved or pending resource
        $existing = Resource::where('file_hash', $fileHash)
            ->whereIn('status', ['approved', 'pending'])
            ->first();

        if ($existing) {
            throw ValidationException::withMessages([
                'file' => "This exact file has already been uploaded as '{$existing->title}'.",
            ]);
        }

        // 6. Generate randomized, unguessable storage filename
        $year = date('Y');
        $month = date('m');
        $randomName = Str::uuid()->toString() . '.' . $extension;
        $storageDirectory = "resources/{$year}/{$month}";
        
        $filePath = $file->storeAs($storageDirectory, $randomName, 'local');

        return [
            'file_path' => $filePath,
            'file_name' => pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension,
            'file_type' => $extension,
            'mime_type' => $detectedMime ?: $file->getMimeType(),
            'file_size' => $fileSizeBytes,
            'file_hash' => $fileHash,
        ];
    }
}
