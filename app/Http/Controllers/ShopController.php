<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    
    public function index()
    {
        try {
            $data = [];

            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'admin' => $this->dataAdmin(),
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
    
    public function searchOnType(Request $request)
    {
        if ($request->ajax()){
            $data = [];
            $data = [
                'produk' => Barang::where('nama_barang','LIKE','%'.$request->search."%")->paginate(6)
            ];
            return view('shop.pagination', compact('data'))->render();
        }    
    }

    public function search(Request $request)
    {
        if ($request->filled('search')){
            try {
                $data = [];
                $data = [
                    'admin' => $this->dataAdmin(),
                    'kategori' => ['Food', 'Drink', 'Cigar'],
                    'produk' => Barang::where('nama_barang','LIKE','%'.$request->search."%")->paginate(6),
                    'produk_terbaru' => Barang::orderBy('updated_at', 'desc')->limit(6)->get()->transform(function ($item, $key) {
                        return [
                            'id' => $item->id_barang,
                            'nama' => $item->nama_barang,
                            'harga' => $item->harga_barang,
                            'gambar' => $item->gambar_barang,
                        ];
                    }),
                ];
                return view('shop.index', compact('data'));
            }catch (ModelNotFoundException $exception) {
            
                return back()->withError($exception->getMessage())->withInput();
            }
        }    
    }

    public function selectCategories(Request $request)
    {
        if ($request->filled('kategori')){
            try {
                if ($request->kategori == "*"){
                    $barang = Barang::paginate(6);
                    $barang_terbaru = Barang::orderBy('updated_at', 'desc')->limit(6)->get()->transform(function ($item, $key) {
                        return [
                            'id' => $item->id_barang,
                            'nama' => $item->nama_barang,
                            'harga' => $item->harga_barang,
                            'gambar' => $item->gambar_barang,
                        ];
                    });
                }
                else{
                    $barang = Barang::where('nama_kategori','LIKE','%'.$request->kategori."%")->paginate(6);
                    $barang_terbaru = Barang::where('nama_kategori','LIKE','%'.$request->kategori."%")->orderBy('updated_at', 'desc')->limit(6)->get()->transform(function ($item, $key) {
                        return [
                            'id' => $item->id_barang,
                            'nama' => $item->nama_barang,
                            'harga' => $item->harga_barang,
                            'gambar' => $item->gambar_barang,
                        ];
                    });
                }
                $data = [];
                $data = [
                    'admin' => $this->dataAdmin(),
                    'kategori' => ['Food', 'Drink', 'Cigar'],
                    'produk' => $barang,
                    'produk_terbaru' => $barang_terbaru,
                ];
                return view('shop.index', compact('data'));
            }catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        }      
    }
}