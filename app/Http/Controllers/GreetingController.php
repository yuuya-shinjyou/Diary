<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DateTime;

class GreetingController extends Controller
{
    public function greeting()
    {
        // $NowTime = new datetime();
    
        // if($NowTime->format('5:00') < $NowTime && $NowTime < $NowTime->format('12:00')){
        //     $greeting = "おはよう";
        // }elseif($NowTime->format('12:00') < $NowTime && $NowTime->format('18:00')){
        //     $greeting = "こんにちは";
        // }else{
        //     $greeting = "こんばんは";
        // }

        return view('login');
    }

    public function posting(Request $request)
    {
        return view('test',[
            "id" => $request->id,
            "pass" => $request->pass
        ]);
    }
}
