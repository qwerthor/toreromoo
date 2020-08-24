<?php

namespace App\Http\Controllers;

use App\Emiten;
use App\Kv;
use App\LeaderGainLoss;
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
        $data['pdDirectPath'] = Kv::find('PD_STOCK_PATH')->value;
        $data['gainloss'] = LeaderGainLoss::with('emiten')->get();
        return view('topgainloss', $data);
    }

    public function getLoss(Request $request)
    {
        $date['start'] = $request->get('start');
        $date['end'] = $request->get('end');
        $mode = $request->get('mode');
        
        $date['start'] = \DateTime::createFromFormat('m/d/Y', $date['start']);
        $date['end'] = \DateTime::createFromFormat('m/d/Y', $date['end']);

        $date['start'] = $date['start']->format('d M Y');
        $date['end'] = $date['end']->format('d M Y');

        if ($mode == "gain") $mode = "gainers";
        if ($mode == 'loss') $mode = "losers";

        $startDate = $date['start'];
        $endDate = $date['end'];
        $path = Kv::find('PD_PATH_GAINLOSS');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path->value);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        //LQ45
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "startDate=11+May+2020&endDate=15+May+2020&stockCode=IHSG%2C+R-LQ45X%2C+XISC%2C+TLKM%2C+BMRI%2C+BARU20%2C+BPRS4%2C+MNRC5%2C+AXRP4%2C+USD-IDR%2C+SGD-IDR%2C+GOLD-IDR&kriteriaPencarian=SELECTION&inputSelection=11&optGLValue=losers");

        //Kompas 100
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, "startDate=$startDate&endDate=$endDate&stockCode=IHSG%2C+R-LQ45X%2C+XISC%2C+TLKM%2C+BMRI%2C+BARU20%2C+BPRS4%2C+MNRC5%2C+AXRP4%2C+USD-IDR%2C+SGD-IDR%2C+GOLD-IDR&kriteriaPencarian=SELECTION&inputSelection=15&optGLValue=losers&startDate=$startDate&endDate=$endDate&stockCode=IHSG%2C+R-LQ45X%2C+XISC%2C+TLKM%2C+BMRI%2C+BARU20%2C+BPRS4%2C+MNRC5%2C+AXRP4%2C+USD-IDR%2C+SGD-IDR%2C+GOLD-IDR&kriteriaPencarian=SELECTION&inputSelection=15&optGLValue=$mode");

        //param gainers untuk top gainers

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

        LeaderGainLoss::truncate();
        $parsed = ParserPD::parseGainLoss($result);
        foreach($parsed as $p){
            $e = Emiten::firstOrCreate(['code' => $p['code']]);
            if (empty($e->name))
            {
                $e->name = $p['code_name'];
                $e->save();
            }

            $l = new LeaderGainLoss();
            $l->emiten_id = $e->emiten_id;
            $l->change_percent = $p['change_percent'];
            $l->change = str_replace(',', '', $p['change']);
            $l->close = str_replace(',', '', $p['close']);
            $l->prev = str_replace(',', '', $p['prev']);
            $l->high = str_replace(',', '', $p['high']);
            $l->low = str_replace(',', '', $p['low']);
            $l->high_date = date_create_from_format("d M Y", $p['high_date']);
            $l->low_date = date_create_from_format("d M Y", $p['low_date']);

            $l->save();
        }

        return redirect()->action('EmitenController@toploss');
    }
}
