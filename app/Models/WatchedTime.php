<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchedTime extends Model
{
    protected $fillable = [
        'user_id', 'channel_id', 'minute', 'date'
    ];

    public function getInfoAttribute()
    {
        return  $this->user->name . ' - ' . $this->channel->name;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
