<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function message()
    {
        $messageRooms = Message::join('users', 'users.id', '=', 'messages.user_id')
                                ->join('rooms', 'rooms.id', '=', 'messages.room_id')
                                ->where('messages.user_id', Auth::user()->id)
                                ->select('messages.user_id', 'messages.room_id', 'rooms.room_name', 'messages.talk', 'messages.created_at')
                                ->orderBy('messages.created_at', 'desc')
                                ->distinct('messages.room_id')
                                ->get();

        $messages = $messageRooms->groupBy('room_id')->toArray();
        
        $indRoom = [];
        foreach($messages as $m){
            $indRoom[] = $m[0];
        } 
        
        return view("message", ['indRoom' => $indRoom]);
    }

    public function chat($id)
    {
        $messages = Message::join('rooms', 'rooms.id', '=', 'messages.room_id')
                            ->join('users', 'users.id', '=', 'messages.user_id')
                            ->where('messages.room_id', $id)
                            ->orderBy('messages.created_at', 'desc')
                            ->get();

        // dd($messages)

        return view('chatRoom', ['messages' => $messages]);
    }
}
