<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class TesController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    use \App\Http\Traits\ShopTrait;
    
    public function index(){
        $data = [];

        $data = $this->getAllBarangWithPaginate();

        $data['tes'] = Transaksi::findOrFail(1);
        // return response()->json($data, 200);
        return view('tes', compact('data'));
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    public function post(Request $request){
        $data = [];

        $data = $this->getAllBarangWithPaginate();

        return response()->json([$this->getIp(), \Request::ip()], 200);

        $data['tes'] = Transaksi::findOrFail(1);
        // return response()->json($data, 200);
        return redirect()->back();
    }
}