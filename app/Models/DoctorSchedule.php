<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'slot_duration',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'slot_duration' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: DoctorSchedule belongs to a Doctor.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Scope: Active schedules only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get formatted day name (e.g., Monday).
     */
    public function getFormattedDayAttribute()
    {
        return ucfirst($this->day_of_week);
    }

    /**
     * Get readable time range (e.g., 09:00 AM - 05:00 PM).
     */
    public function getTimeRangeAttribute()
    {
        return $this->start_time->format('h:i A') . ' - ' . $this->end_time->format('h:i A');
    }
}
