<?php

namespace App\Http\Controllers;

use App\Lib\ParserPD;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboard(){
        return view('dashboard');
    }
}
