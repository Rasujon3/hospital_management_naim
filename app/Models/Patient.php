<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'emergency_contact',
        'medical_history',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Relationship: A patient belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A patient may have many appointments.
     */
    public function appointments()
    {
        return $this->hasMany(App\Models\Appointment::class);
    }

    /**
     * Accessor: Get age from date_of_birth.
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    /**
     * Scope: Filter by gender.
     */
    public function scopeGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }
}
