<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'semester_number',
        'name',
        'slug',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'semester_number' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }
}
