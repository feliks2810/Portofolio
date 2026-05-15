<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'position', 'description', 'responsibilities',
        'location', 'type', 'tech_stack', 'start_date', 'end_date',
        'is_current', 'company_logo', 'sort_order', 'is_active'
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'tech_stack' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getDurationAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end = $this->is_current ? 'Present' : ($this->end_date ? $this->end_date->format('M Y') : 'Present');
        return "{$start} – {$end}";
    }
}
