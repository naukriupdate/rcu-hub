<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id',
        'uploader_type',
        'uploader_name',
        'department_id',
        'program_id',
        'branch_id',
        'semester_id',
        'subject_id',
        'resource_type_id',
        'academic_year',
        'file_path',
        'file_name',
        'file_type',
        'mime_type',
        'file_size',
        'file_hash',
        'status',
        'rejection_reason',
        'downloads_count',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'downloads_count' => 'integer',
            'approved_at' => 'datetime',
        ];
    }

    // Scopes
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhereHas('subject', function ($sq) use ($term) {
                  $sq->where('name', 'like', "%{$term}%")
                     ->orWhere('code', 'like', "%{$term}%");
              })
              ->orWhereHas('program', function ($pq) use ($term) {
                  $pq->where('name', 'like', "%{$term}%")
                     ->orWhere('code', 'like', "%{$term}%");
              });
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function resourceType(): BelongsTo
    {
        return $this->belongsTo(ResourceType::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(ResourceDownload::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    // Helpers
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isTeacherUpload(): bool
    {
        return $this->uploader_type === 'teacher';
    }

    public function isVerifiedTeacherUpload(): bool
    {
        return $this->isTeacherUpload() && $this->user && $this->user->isVerifiedTeacher();
    }

    public function humanFileSize(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 1) . ' ' . $units[$i];
    }
}
