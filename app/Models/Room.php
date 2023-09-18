<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsToMany(Room::class, 'user_rooms', 'user_id', 'room_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }
}
