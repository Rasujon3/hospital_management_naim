<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\DoctorSchedule;
use App\Models\Appointment;
use App\Models\NotificationSetting;
use App\Models\Patient;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Get all appointments (if doctor or patient).
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, $this->role === 'doctor' ? 'doctor_id' : 'patient_id');
    }

    /**
     * If doctor, get schedules.
     */
    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    /**
     * If patient, get extended profile.
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Notification Settings
     */
    public function notificationSettings()
    {
        return $this->hasMany(NotificationSetting::class);
    }
}
