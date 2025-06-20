<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'qualification',
        'experience_years',
        'consultation_fee',
        'status',
    ];

    protected $casts = [
        'consultation_fee' => 'decimal:2',
        'experience_years' => 'integer',
    ];

    /**
     * Relationship: Doctor belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Doctor has many Appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * Scope: Active doctors only.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Accessor: Full Name (from related User).
     */
    public function getFullNameAttribute()
    {
        return optional($this->user)->name;
    }
}
