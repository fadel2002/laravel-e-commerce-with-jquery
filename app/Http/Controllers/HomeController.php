<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class HomeController extends Controller
{
    use \App\Http\Traits\AdminTrait;

    public function index()
    {
        try {
            $data = [];
            if (Auth::check()){
                $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
            }else{
                $transaksi = null;
            }
            
            if (!$transaksi){
                $transaksi['total_transaksi'] = 0;
            }
            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'admin' => $this->dataAdmin(),
                'user' => User::get(),
                'produk' => Barang::orderBy('harga_barang', 'desc')->limit(8)->get(),
                'total_transaksi' => $transaksi['total_transaksi'],
            ];
            return view('home.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}