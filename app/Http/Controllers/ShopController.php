<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    use \App\Http\Traits\ShopTrait;
    
    public function index()
    {
        try {
            $data = [];

            $data = $this->getAllBarangWithPaginate();

            // dd($data);
            
            return view('shop.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function detail($id)
    {
        try {
            $data = [];

            $barang = Barang::with('gambarBarangs')->where('id_barang', $id)->first();
            $barang_mirip = Barang::where('nama_kategori', $barang->nama_kategori)->limit(4)->get();
    
            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'admin' => $this->dataAdmin(),
                'produk' => [
                    'id' => $barang->id_barang,
                    'nama' => $barang->nama_barang,
                    'harga' => $barang->harga_barang,
                    'gambar' => $barang->gambar_barang,
                    'deskripsi' => $barang->deskripsi_barang,
                    'berat' => $barang->berat_barang,
                    'stok' => $barang->stok_barang,
                    'gambar_lain' => $barang->gambarBarangs->transform(function ($item, $key) {
                                        return [
                                            'gambar' => $item->gambar_barang,
                                        ];  
                                    }),
                ],
                'produk_mirip' => $barang_mirip->transform(function ($item, $key) {
                    return [
                        'id' => $item->id_barang,
                        'nama' => $item->nama_barang,
                        'harga' => $item->harga_barang,
                        'gambar' => $item->gambar_barang,
                    ];
                }),
            ];

            // return response()->json([
            //     'data' => $data['produk'],
            // ], 200);
            
            return view('shop.detail', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    // ajax
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
    
    // ajax
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

    // ajax
    public function searchAjax(Request $request)
    {
        if ($request->ajax()){
            try {
                $data = [];
                $data = [
                    'produk' => Barang::where('nama_barang','LIKE','%'.$request->search."%")->paginate(6),
                ];
                return view('shop.pagination', compact('data'))->render();
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

    /* POST REQUEST */
    public function addToCart(Request $request){
        $data = [];
        return response()->json([
            'data' => $request->all(),
        ], 200);
    }
}