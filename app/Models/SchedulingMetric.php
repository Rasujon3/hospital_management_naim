<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulingMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'algorithm_type',
        'total_appointments',
        'successful_bookings',
        'average_waiting_time',
        'resource_utilization_rate',
        'patient_satisfaction_score',
        'execution_time_ms',
        'date_recorded',
    ];

    protected $casts = [
        'date_recorded' => 'date',
        'average_waiting_time' => 'float',
        'resource_utilization_rate' => 'float',
        'patient_satisfaction_score' => 'float',
    ];

    /**
     * Scope: Filter metrics by algorithm type.
     */
    public function scopeByAlgorithm($query, $algorithm)
    {
        return $query->where('algorithm_type', $algorithm);
    }

    /**
     * Accessor: Get formatted utilization rate (e.g. "85.50%").
     */
    public function getFormattedUtilizationRateAttribute()
    {
        return number_format($this->resource_utilization_rate, 2) . '%';
    }

    /**
     * Accessor: Get satisfaction rating out of 5 stars (e.g. ★★★★☆).
     */
    public function getStarRatingAttribute()
    {
        $stars = floor($this->patient_satisfaction_score);
        return str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
    }
}
