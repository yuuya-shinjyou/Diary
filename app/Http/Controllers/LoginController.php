<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\blog;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function show()
    {
        // if(Auth::check()){
        //     $user = User::where('email', Auth()->user()->id)->first();
        //     $blogs = Blog::orderBy('blogs.created_at', 'desc');
        //     return view('diary', ['user' => $user, 'blogs' => $blogs]);
        // } else {
        //     return redirect()->route('login')->with('timeOut', 'タイムアウトしました');
        // }
    }

    public function loggedIn(LoginRequest $request)
    {
        // 投稿後のリダイレクトは別で処理する必要あり。
        if(Auth::attempt(['email' => $request->id, 'password' => $request->password])){
            return redirect()->route('diary.index')->with('success', 'ログインに成功しました');

        } else {
            if (User::where('email', $request->id)->first()) {
                return back()->with('failed', 'ログインに失敗しました');
            } else {
                return back()->with('question', '登録がないようです');
            }
        }
    }
}
