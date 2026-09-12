<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResourceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'icon',
        'color_theme',
        'description',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }
}
