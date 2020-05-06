<?php

namespace App\Lib;

use App\Emiten;
use App\Portfolio;

class ParserPD
{
    public static function retrieveEmiten($code)
    {
    }

    public static function parsePortfolio($html)
    {
    }

    public static function parseGainLoss($html)
    {
        //Curl post
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);

        $dom->loadHTML($html);
        $tr = $dom->getElementsByTagName('tr');

        $parsed = [];

        foreach ($tr as $t) {
            $cols = $t->getElementsByTagName('td');
            if ($cols->length != 0){ 
                $code = $cols[1]->getElementsByTagName('span')->item(0)->getElementsByTagName('span');

                $nr['code'] = $code[0]->nodeValue;
                $nr['code_name'] = $code[1]->nodeValue;
                $nr['change_percent'] = $cols[2]->nodeValue;
                $nr['change'] = $cols[3]->nodeValue;
                $nr['close'] = $cols[4]->nodeValue;
                $nr['prev'] = $cols[5]->nodeValue;
                $nr['high'] = $cols[6]->nodeValue;
                $nr['low'] = $cols[7]->nodeValue;
                $nr['high_date'] = $cols[8]->nodeValue;
                $nr['low_date'] = $cols[9]->nodeValue;
                $parsed[] = $nr;
            }
        }

        return $parsed;
    }

    public static function parsePortfolionJson($json)
    {
        //CURL + SESSION?, meh parse manual dulu.
        $d = json_decode($json);

        $portList = [];
        foreach ($d->aaData as $x) {
            if (strlen($x[2]) != 4)
                abort(403, 'Huh? something is wrong with emiten code');

            $portList[] = [
                'emiten_id' => Emiten::firstOrCreate(['code' => $x[2]])->emiten_id,
                'share_lot' => floatval(str_replace(",", "", $x[4])),
                'avg_price' => floatval(str_replace(",", "", $x[3])),
                'last_price' => floatval(str_replace(",", "", $x[5])),
            ];
        }

        return $portList;
    }
}
