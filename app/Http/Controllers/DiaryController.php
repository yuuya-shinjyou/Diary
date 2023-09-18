<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostDiaryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\blog;
use App\Models\User;

class DiaryController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $blogs = User::join('blogs', 'blogs.AccountNum', '=', 'users.id')
                            ->orderBy('blogs.created_at', 'desc')
                            ->get();
            
            return view('diary', ['blogs' => $blogs]);
        } else {
            return redirect('login')->with('timeOut', 'タイムアウトしました');
        }

    }

    public function mylist()
    {
        if(Auth::check()){
            $myBlogs = User::join('blogs', 'users.id', '=', 'blogs.AccountNum')
                                ->where('users.id', Auth::user()->id)
                                ->orderBy('blogs.created_at', 'desc')
                                ->get();
            return view('diary', ['blogs' => $myBlogs]);
        } else {
            return redirect('login')->with('timeOut', 'タイムアウトしました');
        }
    }

    public function search(Request $request)
    {
        if(Auth::check()){
            $validatedData = $request->validate([
                'inputSearch' => 'nullable|string|max:50',
            ]);

            $searchValue = $request->input('inputSearch');
            $resultSearch = User::join('blogs', 'users.id', '=', 'blogs.AccountNum')
                                ->where('blogs.body', 'LIKE BINARY', '%' . $searchValue . '%')
                                ->orderBy('blogs.created_at', 'desc')
                                ->get();
            
            if($resultSearch->isEmpty()){
                $resultSearch = User::join('blogs', 'users.id', '=', 'blogs.AccountNum')
                                    ->orderBy('blogs.created_at', 'desc')
                                    ->get();
            }

            return view('diary', ['blogs' => $resultSearch, 'search' => $searchValue]);
        } else {
            return redirect('login')->with('timeOut', 'タイムアウトしました');
        }
    }

    public function post(PostDiaryRequest $request)
    {
        if(!Auth::check()){
            return redirect('login')->with('timeOut', 'タイムアウトしました');
        }

        $validatedData = $request->validated();

        $blog = new blog();
        $blog->AccountNum = Auth::user()->id;
        $blog->title = $validatedData['title'];
        $blog->weather = $validatedData['weather'];
        $blog->body = $validatedData['body'];

        $blog->save();

        return redirect()->route('diary.index')->with('success', '投稿しました');
    }

    public function logOut()
    {
        return redirect()->route('login')->with('success', 'ログアウトしました');
    }


}
