<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function loggedIn(LoginRequest $request)
    {
        // 送信されたデータ
        $InputLoginData = $request->validated();
        $email = $InputLoginData["id"];
        $password = $InputLoginData["password"];

        // データベースから抜き出し
        $Items = User::where("email",$email)->first();

        if(empty($Items)){
            return redirect('login')->with('question','登録がないようです');
        }
        
        if($Items["email"] === $email && Hash::check($password,$Items["password"])) {
            // セッションを渡すためにリダイレクトでアクセス
            return redirect('diary')->with('success','ログインに成功しました');
        } else {
            return redirect('login')->with('failed','ログインに失敗しました');
        }
    }

    public function loginFailed()
    {
        // データベースと入力内容を照合
        
        // フラッシュメッセージにfailedを送信
        return view('login')->with('failed','ログインに失敗しました');
    }
}
