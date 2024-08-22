<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function myToken()
    {
        $userToken = Auth::user();

        return view('Api', compact('userToken'));
    }
}
