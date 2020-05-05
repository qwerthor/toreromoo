<?php

namespace App\Lib;

use App\Emiten;
use App\Portfolio;

class ParserPD {
    public static function retrieveEmiten($code){

    }

    public static function parsePortfolio($html){
        
    }

    public static function parseGainLoss($html){
        //Curl post
        
    }

    public static function parsePortfolionJson($json){
        //CURL + SESSION?, meh parse manual dulu.
        $d = json_decode($json);

        $portList = [];
        foreach ($d->aaData as $x){
            if (strlen($x[2]) != 4)
                abort(403, 'Huh? something is wrong with emiten code'); 

            $portList[] = [
                'emiten_id' => Emiten::firstOrCreate(['code' => $x[2]])->emiten_id,
                'share_lot' => floatval(str_replace(",", "",$x[4])),
                'avg_price' => floatval(str_replace(",", "",$x[3])),
                'last_price' => floatval(str_replace(",", "",$x[5])),
            ];
        }
        
        return $portList;
    }
}