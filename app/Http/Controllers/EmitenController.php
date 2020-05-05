<?php

namespace App\Http\Controllers;

use App\Emiten;
use Illuminate\Http\Request;

class EmitenController extends Controller
{
    public function index()
    {
        $data['emiten'] = Emiten::all();
        return view('emiten', $data);
    }
}
