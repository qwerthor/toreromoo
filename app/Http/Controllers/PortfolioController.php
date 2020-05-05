<?php

namespace App\Http\Controllers;

use App\Lib\ParserPD;
use App\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        $data['portfolio'] = Portfolio::with('emiten')->get();
        return view('portfolio', $data);
    }

    public function parsePortfolio(Request $request){
        $parsed = ParserPD::parsePortfolionJson($request->get('data'));


        Portfolio::truncate();
        if (Portfolio::insert($parsed)){
            return ['success' => 1];
        }
        //dd($parsed);
    }
}
