<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function loggedIn(Request $request)
    {
        // データベースと比較
        $Items = User::all();
        dd($Items);
        // dd($request->id,$request->pass);

        // セッションを渡すためにリダイレクトでアクセス
        return redirect('diary')->with('success','ログインに成功しました');
    }

    public function loginFailed()
    {
        // データベースと入力内容を照合
        
        // フラッシュメッセージにfailedを送信
        return view('login')->with('failed','ログインに失敗しました');
    }
}
