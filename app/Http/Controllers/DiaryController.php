<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\blog;

class DiaryController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $blogs = Blog::join('users', 'blogs.AccountNum', '=', 'users.id')
                            ->orderBy('blogs.created_at', 'desc')
                            ->get();
            return view('diary', ['blogs' => $blogs]);
        } else {
            return redirect()->route('posted.show')->with('timeOut', 'タイムアウトしました');
        }

    }

    public function show()
    {

    }

    public function logOut()
    {
        return redirect()->route('login')->with('success', 'ログアウトしました');
    }


}
