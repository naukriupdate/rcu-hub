<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResourceDownload extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'resource_id',
        'user_id',
        'ip_address',
        'user_agent',
        'downloaded_at',
    ];

    protected function casts(): array
    {
        return [
            'downloaded_at' => 'datetime',
        ];
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
