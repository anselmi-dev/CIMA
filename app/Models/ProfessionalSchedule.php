<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalSchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'professional_id',
        'day_of_week',
        'time',
        'is_presence'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'time' => 'array',
        'day_of_week' => 'int',
        'is_presence' => 'bool'
    ];

    /**
     * Get the professional that owns the schedule.
     *
     * @return BelongsTo
     */
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function scopePresence($query)
    {
        return $query->where('is_presence', true);
    }

    public function scopeVirtual($query)
    {
        return $query->where('is_presence', false);
    }
}