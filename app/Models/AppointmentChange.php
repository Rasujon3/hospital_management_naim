<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'change_type',
        'old_date',
        'old_time',
        'new_date',
        'new_time',
        'reason',
        'handled_by_algorithm',
        'processing_time_ms',
    ];

    protected $casts = [
        'old_date' => 'date',
        'old_time' => 'datetime:H:i',
        'new_date' => 'date',
        'new_time' => 'datetime:H:i',
        'processing_time_ms' => 'integer',
    ];

    /**
     * Relationship: belongs to Appointment.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Accessor: Get full old datetime.
     */
    public function getOldDatetimeAttribute()
    {
        return $this->old_date && $this->old_time
            ? \Carbon\Carbon::parse("{$this->old_date} {$this->old_time}")
            : null;
    }

    /**
     * Accessor: Get full new datetime.
     */
    public function getNewDatetimeAttribute()
    {
        return $this->new_date && $this->new_time
            ? \Carbon\Carbon::parse("{$this->new_date} {$this->new_time}")
            : null;
    }
}
