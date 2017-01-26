<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventsUser extends Model
{
    protected $table = 'events_users';
    protected $fillable = ['event_id', 'user_id'];

    public function event() {
        return $this->belongsTo(\App\Models\Event::class, 'event_id', 'id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
