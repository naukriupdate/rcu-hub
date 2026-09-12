<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'branch_id',
        'name',
        'code',
        'slug',
        'duration_years',
        'total_semesters',
        'description',
        'badge_color',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'duration_years' => 'integer',
            'total_semesters' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class)->orderBy('semester_number');
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
