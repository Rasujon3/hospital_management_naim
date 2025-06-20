<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'status',
        'booking_type',
        'priority_level',
        'symptoms',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
    ];

    /**
     * Relationships
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Accessor: Get full scheduled datetime.
     */
    public function getScheduledAtAttribute()
    {
        return \Carbon\Carbon::parse($this->appointment_date . ' ' . $this->appointment_time);
    }

    /**
     * Scope: Filter upcoming appointments.
     */
    public function scopeUpcoming($query)
    {
        return $query->whereDate('appointment_date', '>=', now()->toDateString());
    }

    /**
     * Scope: Filter past appointments.
     */
    public function scopePast($query)
    {
        return $query->whereDate('appointment_date', '<', now()->toDateString());
    }

    /**
     * Scope: Filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Filter by booking type.
     */
    public function scopeBookingType($query, $type)
    {
        return $query->where('booking_type', $type);
    }
}
