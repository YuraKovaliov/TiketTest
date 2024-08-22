<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\testTi;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    public function index()
    {

        return testTi::all();
    }


}
