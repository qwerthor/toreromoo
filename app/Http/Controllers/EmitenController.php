<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmitenController extends Controller
{
    public function index()
    {
        return view('emiten');
    }
}
