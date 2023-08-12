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
        return view('diary');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('NewCreate');
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
    
            return redirect('login');

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

