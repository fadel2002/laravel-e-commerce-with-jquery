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
    use \App\Http\Traits\ShopTrait;

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
                'kategori' => $this->kategori,
                'admin' => $this->dataAdmin(),
                'user' => User::get(),
                'produk_food' => Barang::where('nama_kategori', 'Food')->orderBy('harga_barang', 'desc')->limit(3)->get(),
                'produk_drink' => Barang::where('nama_kategori', 'Drink')->orderBy('harga_barang', 'desc')->limit(3)->get(),
                'produk_cigar' => Barang::where('nama_kategori', 'Cigar')->orderBy('harga_barang', 'desc')->limit(2)->get(),
                'total_transaksi' => $transaksi['total_transaksi'],
            ];
            return view('home.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}