<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function message()
    {
        $results = DB::table('user_rooms')
                        ->select('user_rooms.user_id', 'user_rooms.room_id', 'rooms.room_name', 'messages.talk', 'messages.created_at')
                        ->leftJoin('messages', function ($join) {
                            $join->on('messages.room_id', '=', 'user_rooms.room_id');
                        })
                        ->join('rooms', 'user_rooms.room_id', '=', 'rooms.id')
                        ->join('users', 'users.id', '=', 'messages.user_id')
                        ->where('user_rooms.user_id', '=', Auth::user()->id)
                        ->orderBy('messages.created_at', 'DESC')
                        ->get();
                        // dd($results);

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
// dd($talkRooms);
        return view("message", ['talkRoom' => $talkRooms]);
    }

    public function chat($roomId)
    {
        $messages = DB::table('user_rooms')
                        ->select('user_rooms.user_id', 'users.nickname', 'messages.talk', 'messages.created_at',)
                        ->leftJoin('messages', function($join) {
                            $join->on('user_rooms.room_id', '=', 'messages.room_id')
                                ->on('user_rooms.user_id', '=', 'messages.user_id');
                        })
                        ->join('users', 'users.id', '=', 'messages.user_id')
                        ->where('user_rooms.room_id', '=', $roomId)
                        ->orderBy('messages.created_at', 'asc')
                        ->get();

                        // dd($roomId);
        $messages = $messages->filter(function ($message) {
            return $message->talk !== null;
        });

        return view('chatRoom', ['messages' => $messages, 'roomId' => $roomId]);
    }

    public function send(Request $request, $roomId)
    {
        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->room_id = $roomId;
        $message->talk = $request['messageText'];
        $message->created_at = Carbon::now();

        $message->save();

        return redirect()->route('message.chat', ['roomId' => $roomId]);
    }
}
