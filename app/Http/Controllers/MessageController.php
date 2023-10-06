<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\User_room;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\Admin\CreateGroupRequest;
use App\Models\Room_class;

class MessageController extends Controller
{
    public function message()
    {
        $userRooms = DB::table('user_rooms')
                        ->where('user_id', '=', Auth::user()->id)
                        ->get();
        
        $results = DB::table('user_rooms')
                        ->select('user_rooms.user_id', 'user_rooms.room_id', 'users.nickname', 'messages.talk', 'rooms.room_name', 'messages.created_at', 'room_class.class')
                        ->leftJoin('messages', function ($join) {
                            $join->on('messages.room_id', '=', 'user_rooms.room_id')
                                ->on('messages.user_id', '=', 'user_rooms.user_id');
                        })
                        ->join('rooms', 'rooms.id', '=', 'user_rooms.room_id')
                        ->join('users', 'users.id', '=', 'user_rooms.user_id')
                        ->join('room_class', 'room_class.room_id', '=', 'user_rooms.room_id')
                        ->whereIn('user_rooms.room_id', $userRooms->pluck('room_id'))
                        ->orderBy('messages.created_at', 'DESC')
                        ->get();

        // room_idごとに初めのメッセージを取得したい
        $talkRooms = [];
        foreach ($results->groupBy('room_id') as $room) {
            // 各部屋の最初のメッセージを取得
            $firstMessage = $room->first();

            if($firstMessage->class === 2){
                $talkRoom = (object) [
                    'room_id' => $firstMessage->room_id,
                    'room_name' => $firstMessage->room_name,
                    'talk' => $firstMessage->talk,
                    'created_at' => $firstMessage->created_at,
                    'class' => $firstMessage->class,
                ];

                $talkRooms[] = $talkRoom;

            } else {
                $indChat = $room->pluck('nickname', 'user_id')->all();
                unset($indChat[Auth::user()->id]);

                $talkRoom = (object) [
                    'room_id' => $firstMessage->room_id,
                    'room_name' => current($indChat),
                    'talk' => $firstMessage->talk,
                    'created_at' => $firstMessage->created_at,
                    'class' => $firstMessage->class,
                ];

                $talkRooms[] = $talkRoom;
            }
        }

        $friends = User::select('id', 'nickname', 'avatar')
                        ->where('id', '<>', Auth::user()->id)
                        ->get();
        
        return view("message", ['talkRoom' => $talkRooms, 'friends' => $friends]);
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

    public function contact($partner)
    {
        $Rooms = User_room::select('room_id', DB::raw('count(room_id)'))
                            ->groupBy('room_id')
                            ->havingRaw('count(room_id) = 2')
                            ->get();

        $talkRoom_users = User::join('user_rooms', 'user_rooms.user_id', '=', 'users.id')
                                ->select('user_rooms.room_id', 'user_rooms.user_id')
                                ->whereIn('user_rooms.room_id', $Rooms->pluck('room_id'))
                                ->orderby('user_rooms.room_id', 'asc')
                                ->get();

        // dd($talkRoom_users->groupby('room_id'));
        foreach ($talkRoom_users->groupBy('room_id') as $room_id => $users) {
            $user_ids = $users->pluck('user_id')->toArray();
            if(in_array($partner, $user_ids) && in_array(Auth::user()->id, $user_ids)){
                $talkRoom = $room_id;
                break;
            }
        }

        if(isset($talkRoom)){
            // チャットルームに移動
            return redirect()->route('message.chat', ['roomId' => $talkRoom]);
        } else {
            //個人チャットの作成

            // roomsの作成
            $rooms = new Room;
            $rooms->room_name = Auth::user()->id . 'と' . $partner . 'の部屋';
            $rooms->created_at = Carbon::now();
            $rooms->save();

            // user_roomsの作成
            $userRoom1 = new User_room;
            $userRoom1->user_id = Auth::user()->id;
            $userRoom1->room_id = Room::max('id'); 
            $userRoom1->created_at = Carbon::now();
            $userRoom1->save();
            
            $userRoom2 = new User_room;
            $userRoom2->user_id = $partner;
            $userRoom2->room_id = Room::max('id'); 
            $userRoom2->created_at = Carbon::now();
            $userRoom2->save();

            return redirect()->route('message.chat', ['roomId' => Room::max('id')]);
        }
    }

    public function createGroupChat(CreateGroupRequest $request)
    {
        // 部屋を新しく作成
        $room = new Room;
        $room->room_name = $request->title;
        $room->created_at = Carbon::now();
        $room->save();

        // room_classにデータを追加
        $room_class = new Room_class;
        $room_class->room_id = Room::max('id');
        $room_class->peopleNum = count($request->members);
        $room_class->class = 2;
        $room_class->save();

        // 参加メンバーを登録
        foreach($request->members as $member){
            $userRoom = new User_room;
            $userRoom->user_id = $member;
            $userRoom->room_id = Room::max('id');
            $userRoom->save();
        }

        // 自分自身を追加
        $userRoom = new User_room;
        $userRoom->user_id = Auth::user()->id;
        $userRoom->room_id = Room::max('id');
        $userRoom->save();

        return redirect()->route('message.message')->with('success', 'グループを作成しました');
    }
}
