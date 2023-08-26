<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PostDiaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\blog;


class PostScreenController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('postScreen');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostDiaryRequest $request)
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

        return redirect()->route('user.loggedIn')->with('success', '投稿しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
