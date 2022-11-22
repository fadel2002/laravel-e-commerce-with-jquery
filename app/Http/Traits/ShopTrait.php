<?php

namespace App\Http\Traits;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

trait ShopTrait {
    private function getAllBarangWithPaginate(){
        $data = [];
        $data = [
            'kategori' => ['Food', 'Drink', 'Cigar'],
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
        ];
        return $data;
    }
}