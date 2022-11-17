<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        try {
            $data = [];

            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'user' => User::get(),
                'produk' => Barang::paginate(6),
                // 'produk' => Barang::paginate(2)->transform(function ($item, $key) {
                //     return [
                //         'id' => $item->id_barang,
                //         'nama' => $item->nama_barang,
                //         'harga' => $item->harga_barang,
                //         'gambar' => $item->gambar_barang,
                //     ];
                // }),
                'produk_terbaru' => Barang::orderBy('updated_at', 'desc')->limit(6)->get()->transform(function ($item, $key) {
                    return [
                        'id' => $item->id_barang,
                        'nama' => $item->nama_barang,
                        'harga' => $item->harga_barang,
                        'gambar' => $item->gambar_barang,
                    ];
                }),
            ];

            // dd($data);
            
            return view('shop.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function getMoreData(Request $request)
    {
        if ($request->ajax()){
            $data = [];
            $data = [
                'produk' => Barang::paginate(6)
            ];
            return view('shop.pagination', compact('data'))->render();
        }    
    }
}