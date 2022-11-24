<?php

namespace App\Http\Traits;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

trait ShopTrait {
    
    private $ongkir = 2000;

    private $kategori = ['Food', 'Drink', 'Cigar'];

    private function getAllBarangWithPaginate(){
        $data = [];
        $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
        if (!$transaksi){
            $transaksi['total_transaksi'] = 0;
        }
        $data = [
            'kategori' => $this->kategori,
            'admin' => $this->dataAdmin(),
            'produk' => Barang::paginate(6),
            'produk_terbaru' => Barang::orderBy('updated_at', 'desc')->limit(6)->get()->transform(function ($item, $key) {
                return [
                    'id' => $item->id_barang,
                    'nama' => $item->nama_barang,
                    'harga' => $item->harga_barang,
                    'gambar' => $item->gambar_barang,
                ];
            }),
            'current_kategori' => '*',
            'total_transaksi' => $transaksi['total_transaksi'],
        ];
        return $data;
    }
}