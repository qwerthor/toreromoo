<?php

namespace App\Http\Controllers;

use App\Emiten;
use App\Kv;
use App\Lib\ParserPD;
use Illuminate\Http\Request;

class EmitenController extends Controller
{
    public function index()
    {
        $data['emiten'] = Emiten::orderBy('code')->get();
        return view('emiten', $data);
    }

    public function toploss()
    {
        return view('topgainloss');
    }

    public function getLoss()
    {
        $path = Kv::find('PD_PATH_GAINLOSS');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path->value);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "startDate=05+May+2020&endDate=06+May+2020&stockCode=IHSG%2C+R-LQ45X%2C+XISC%2C+TLKM%2C+BMRI%2C+BARU20%2C+BPRS4%2C+MNRC5%2C+AXRP4%2C+USD-IDR%2C+SGD-IDR%2C+GOLD-IDR&kriteriaPencarian=SELECTION&inputSelection=15&optGLValue=losers");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept: */*';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        ParserPD::parseGainLoss($result);
    }
}
