<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreBlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = [
            "北海道" => ["北海道"],
            "東北" => ["青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県"],
            "関東" => ["茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県"],
            "中部" => ["新潟", "富山","石川","福井","山梨県","長野県","岐阜県", "静岡県","愛知県",],
            "近畿" => ["三重県" ,"滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県"],
            "近畿" => ["三重県" ,"滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県"],
            "中国" => ["鳥取県", "島根県","岡山県","広島県","山口県"],
            "四国" => ["徳島県", "香川県","愛媛県","高知県"],
            "九州・沖縄" => ["福岡県","佐賀県","長崎県","熊本県","大分県","宮崎県" ,"鹿児島県","沖縄県"]
        ];
        return view('NewCreate',compact("areas"));
    }

    //投稿処理
    public function store(StoreBlogRequest $request)
    {
        try {
            // バリデーションを行う
            $validatedData = $request->validated();
            
            //publicディスクのblogsに保管
            if (!$request->hasFile('avatar')) {
                // $validatedData['avatar'] = null;
                $imagePath = null;
            } else {
                $imagePath = $request->file('avatar')->store('blogs', 'public');
            }

            $users = new User($validatedData);
            $users->nickname = $request->nickname;
            $users->avatar = $imagePath;

            //重複があった場合追加せずにエラーメッセージを送る処理を追加する
            $users->save();

            return redirect('login')->with("success","登録が完了しました");

        } catch (\Illuminate\Validation\ValidationException $e) {
            // バリデーションエラーが発生した場合、エラーメッセージをログに記録
            Log::debug('Validation failed: ');
    
            // エラーメッセージを元のフォームに戻してユーザに表示するなどの処理
            return back()->withErrors($e->errors())->withInput();
        }
    }    


    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {
        //
    }
}

