<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function setUserDataInSession($userData)
    {
        session(['user_data' => $userData]);
    }

    protected function getUserDataFromSession()
    {
        return session('user_data');
    }
}
