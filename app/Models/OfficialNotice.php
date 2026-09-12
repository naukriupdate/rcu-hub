<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialNotice extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'source',
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'published_at',
        'featured_image_url',
        'original_url',
        'is_new',
        'is_active',
        'last_synced_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'last_synced_at' => 'datetime',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopeCategory(Builder $query, ?string $category): Builder
    {
        if (empty($category) || strtolower($category) === 'all' || strtolower($category) === 'latest') {
            return $query;
        }

        return $query->where('category', $category);
    }
}
