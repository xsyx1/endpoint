<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the watchedTimes for the Channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watchedTimes()
    {
        return $this->hasMany(WatchedTime::class, 'channels_id');
    }
}
