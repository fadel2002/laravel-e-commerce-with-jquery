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
        return response()->json($data, 200);
        return view('tes', compact('data'));
    }
}