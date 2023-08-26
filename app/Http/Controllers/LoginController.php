<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function show()
    {
        return view('login');
    }

    public function loggedIn(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->id, 'password' => $request->password])){
            $user = User::where('email', $request->id)->first();
            return redirect()->route('user.loggedIn',['user', $user])->with('success', 'ログインに成功しました');
        } else {
            if (User::where('email', $request->id)->first()) {
                return back()->with('failed', 'ログインに失敗しました');
            } else {
                return back()->with('question', '登録がないようです');
            }
        }

        // 送信されたデータ
        $InputLoginData = $request->validated();
        $InputMail = $InputLoginData["id"];
        $InputPassword = $InputLoginData["password"];

        // データベースから抜き出し
        $Items = User::where("email",$InputMail)->first();

        if(empty($Items)){
            return redirect('login')->with('question','登録がないようです');
        }
        
        $UserName = $Items["nickname"]; 
        $UserMail = $Items["email"];
        $UserPass = $Items["password"];

        if($UserMail === $InputMail && Hash::check($InputPassword,$UserPass)) {

            // セッション格納
            $userData = ['id' => $Items['id'],'nickname' => $Items['nickname']];
            $this->setUserDataInSession($userData);

            // フラッシュメッセージを渡すためにリダイレクトでアクセス
            return redirect('diary')->with('success','ようこそ' . $UserName . 'さん');

        } else {
            return redirect('login')->with('failed','ログインに失敗しました');
        }
    }
}
