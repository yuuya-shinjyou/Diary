<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function show()
    {

    }

    public function logOut()
    {
        return redirect()->route('login')->with('success', 'ログアウトしました');
    }


}

//                                 ->when($searchValue !== 'null', function($query) use ($searchValue) {
//     return $query->where('blogs.body', 'like', '%' . $searchValue['inputSearch'] . '%');
// })