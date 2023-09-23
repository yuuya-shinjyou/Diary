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
        $results = DB::table('user_rooms')
                        ->select('user_rooms.user_id', 'user_rooms.room_id', 'rooms.room_name', 'messages.talk', 'messages.created_at')
                        ->leftJoin('messages', function ($join) {
                            $join->on('messages.room_id', '=', 'user_rooms.room_id')
                                ->on('messages.user_id', '=', 'user_rooms.user_id');
                        })
                        ->join('rooms', 'user_rooms.room_id', '=', 'rooms.id')
                        ->where('user_rooms.user_id', '=', Auth::user()->id)
                        ->orderBy('messages.created_at', 'DESC')
                        ->get();

        // room_idごとに初めのメッセージを取得したい
        $talkRooms = [];
        foreach ($results->groupBy('room_id') as $room) {
            // 各部屋の最初のメッセージを取得
            $firstMessage = $room->first();
        
            // talkRoomオブジェクトを作成し、配列に追加
            $talkRoom = (object) [
                'room_id' => $firstMessage->room_id,
                'room_name' => $firstMessage->room_name,
                'talk' => $firstMessage->talk,
                'created_at' => $firstMessage->created_at,
            ];
        
            $talkRooms[] = $talkRoom;
        }

        return view("message", ['talkRoom' => $talkRooms]);
    }

    public function chat($roomId)
    {
        $messages = DB::table('user_rooms')
                        ->select()
                        ->leftJoin('messages', function($join) {
                            $join->on('user_rooms.room_id', '=', 'messages.room_id')
                                ->on('user_rooms.user_id', '=', 'messages.user_id');
                        })
                        ->join('users', 'users.id', '=', 'user_rooms.user_id')
                        ->where('user_rooms.room_id', '=', $roomId)
                        ->orderBy('messages.created_at', 'asc')
                        ->get();

        $messages = $messages->filter(function ($message) {
            return $message->talk !== null;
        });
        // dd($messages);

        return view('chatRoom', ['messages' => $messages, 'roomId' => $roomId]);
    }

    public function send(Request $request, $roomId)
    {
        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->room_id = $roomId;
        $message->talk = $request['messageText'];

        $message->save();

        return redirect()->route('message.chat', ['roomId' => $roomId]);
    }
}
