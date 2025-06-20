<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_type',
        'channel',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * Relationship: NotificationSetting belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Get only enabled settings.
     */
    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Scope: Filter by type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('notification_type', $type);
    }

    /**
     * Scope: Filter by channel.
     */
    public function scopeViaChannel($query, $channel)
    {
        return $query->where('channel', $channel);
    }

    /**
     * Generate a human-readable label.
     */
    public function getLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->notification_type)) . ' via ' . ucfirst($this->channel);
    }
}
