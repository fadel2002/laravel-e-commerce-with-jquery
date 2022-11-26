<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

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

            $cart = Transaksi::where([['id_user', Auth::user()->id_user], ['status_transaksi', 0]])->first();
            $cart_history = 0;
            
            if ($cart){
                $detail_barang = DetailTransaksi::where([['id_barang', $id],['id_transaksi', $cart->id_transaksi]])->first();
                if ($detail_barang){
                    $cart_history = $detail_barang->kuantitas_barang;
                }
            }
            
            $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
            if (!$transaksi){
                $transaksi['total_transaksi'] = 0;
            }
            $data = [
                'kategori' => $this->kategori,
                'admin' => $this->dataAdmin(),
                'produk' => [
                    'id' => $barang->id_barang,
                    'nama' => $barang->nama_barang,
                    'harga' => $barang->harga_barang,
                    'gambar' => $barang->gambar_barang,
                    'kategori' => $barang->nama_kategori,
                    'deskripsi' => $barang->deskripsi_barang,
                    'berat' => $barang->berat_barang,
                    'stok' => $barang->stok_barang,
                    'kuantitas_sementara' => $cart_history,
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
                'total_transaksi' => $transaksi['total_transaksi'],
            ];
            
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
                    'kategori' => $this->kategori,
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

                $barang = Barang::where([['nama_barang','LIKE','%'.$request->search."%"],['nama_kategori','LIKE','%'.$request->kategori."%"]])->paginate(6);

                // return response()->json([
                //     'data' => $barang,
                // ], 200);

                $data = [
                    'produk' => $barang,
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
                $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
                if (!$transaksi){
                    $transaksi['total_transaksi'] = 0;
                }
                // return response()->json([
                //     'data' => $barang,
                // ], 200);
                $data = [
                    'admin' => $this->dataAdmin(),
                    'kategori' => $this->kategori,
                    'produk' => $barang,
                    'current_kategori' => $request->kategori,
                    'produk_terbaru' => $barang_terbaru,
                    'total_transaksi' => $transaksi['total_transaksi'],
                ];
                return view('shop.index', compact('data'));
            }catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        }      
    }

    public function checkout(){
        try {
            $data = [];
            $transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'detailTransaksis.barang:id_barang,nama_barang,harga_barang'])->where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
            if (!$transaksi) {
                $transaksi['detailTransaksis'] = [];
                $transaksi['total_transaksi'] = 0;
            }
            // return response()->json([
            //     'data' => $transaksi,
            // ], 200);
            
            $data = [
                'admin' => $this->dataAdmin(),
                'kategori' => $this->kategori,
                'produk' => $transaksi,
                'total_transaksi' => $transaksi['total_transaksi'],
                'ongkir' => $this->ongkir,
            ];           
            return view('shop.checkout', compact('data'));
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function cart(){
        try {
            $data = [];
            $transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'detailTransaksis.barang:id_barang,nama_barang,stok_barang,harga_barang,gambar_barang'])->where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
            if (!$transaksi) {
                $transaksi['detailTransaksis'] = [];
                $transaksi['total_transaksi'] = 0;
            }
            // return response()->json([
            //     'data' => $transaksi,
            // ], 200);
            
            $data = [
                'admin' => $this->dataAdmin(),
                'kategori' => $this->kategori,
                'produk' => $transaksi,
                'total_transaksi' => $transaksi['total_transaksi'],
            ];            
            return view('shop.cart', compact('data'));
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    
    /* POST REQUEST */

    // ajax
    public function addToCartAjax(Request $request){
        if ($request->ajax()){
            try {
                $data = [];

                $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', $request->id_user]])->first();

                $sum = 0;

                if ($transaksi){
                    $detail_transaksi = DetailTransaksi::where([['id_transaksi', $transaksi->id_transaksi],['id_barang', $request->id_barang]])->first();
                    $total_transaksi = $transaksi->total_transaksi;
                    if ($detail_transaksi){
                        $total_transaksi = $total_transaksi - ((int)$detail_transaksi->kuantitas_barang * (int)$request->harga);
                        if ($request->kuantitas == 0){
                            $detail_transaksi->delete();
                        }else {
                            $detail_transaksi->update([
                                'kuantitas_barang' => $request->kuantitas,
                            ]);
                        }                        
                    }else{
                        if ($request->kuantitas > 0){
                            DetailTransaksi::create([
                                'id_transaksi' => $transaksi->id_transaksi,
                                'id_barang' => $request->id_barang,
                                'kuantitas_barang' => (int)$request->kuantitas,
                            ]);
                        }
                    }
                    $transaksi->update([
                        'total_transaksi' => $total_transaksi + ((int)$request->harga * (int)$request->kuantitas),
                    ]);

                    $sum = $transaksi->total_transaksi;
                }else {
                    $new_transaksi = Transaksi::create([
                        'total_transaksi' => (int)$request->harga * (int)$request->kuantitas,
                        'id_user' => (int)$request->id_user,
                    ]);

                    $sum = $new_transaksi->total_transaksi;

                    if ($request->kuantitas > 0){
                        DetailTransaksi::create([
                            'id_transaksi' => (int)$new_transaksi->id_transaksi,
                            'id_barang' => (int)$request->id_barang,
                            'kuantitas_barang' => (int)$request->kuantitas,
                        ]);
                    }
                }

                return response()->json([
                    'data' => [
                        'total_transaksi' => $sum,
                    ],
                ], 200);
            }catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        } 
    }

    public function updateCart(Request $request){
        // return response()->json([
        //     'id' => $request->id_transaksi,
        //     'data' => $request->updated_data
        // ], 200);
        
        if ($request->ajax()){
            try {
                $transaksi = Transaksi::where([['id_transaksi', (int)$request->id_transaksi],['id_user', Auth::user()->id_user]])->first();
                $sum_per_data = [];
                $sum = 0;
                
                for($i=0; $i<count($request->updated_data); $i++){
                    $id_dt = $request->updated_data[$i]['id_detail_transaksi'];
                    $kuantitas_baru = $request->updated_data[$i]['kuantitas_baru'];

                    $dt = DetailTransaksi::with(['barang:id_barang,harga_barang'])->where('id_detail_transaksi', $id_dt)->first();
                    
                    if ($kuantitas_baru == 0){
                        $dt->delete();
                    }

                    $dt->update([
                        'kuantitas_barang' => $kuantitas_baru,
                    ]);

                    $sum = $sum + ( $kuantitas_baru *  $dt->barang->harga_barang );
                    $sum_per_data[$i] = $kuantitas_baru *  $dt->barang->harga_barang;
                }
                
                $transaksi->update([
                    'total_transaksi' => $sum,
                ]);
                
                return response()->json([
                    'data' => [
                        'total_transaksi' => $sum,
                        'transaksi_per_data' => $sum_per_data
                    ]
                ], 200);
                
            }catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        } 
    }

    public function deleteItem(Request $request){        
        if ($request->ajax()){
            try {
                
                $transaksi = Transaksi::where([['id_transaksi', (int)$request->id_transaksi],['id_user', Auth::user()->id_user]])->first();

                $data = DetailTransaksi::with(['barang:id_barang,harga_barang'])->where('id_detail_transaksi', $request->id_dt)->first();

                $sum = $data->barang->harga_barang * $data->kuantitas_barang;

                $transaksi->update([
                    'total_transaksi' => ($transaksi->total_transaksi - $sum),
                ]);

                $bool = $data->delete();
                
                return response()->json([
                    'data' => [
                       'status' => $bool,
                       'total_transaksi' => $transaksi->total_transaksi,
                    ],
                ], 200);
                
            }catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        } 
    }

    public function checkoutPaymentAjax(Request $request){        
        if ($request->ajax()){
            try {
                $validator = Validator::make($request->all(), [
                    'address' => 'required|min:10',
                    'id_transaksi' => 'required',
                    'payment' => 'required',
                ]);
         
                if ($validator->fails()) {
                    return response()->json([
                        'data' => [
                            'status' => $validator->errors(),
                        ],
                    ], 200);
                }

                $transaksi = Transaksi::with(['detailTransaksis' => function($query){
                    $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
                }])->where([['id_transaksi', (int)$request->id_transaksi],['id_user', Auth::user()->id_user],['status_transaksi', 0]])->first();

                if (!$transaksi){
                    return response()->json([
                        'data' => [
                           'status' => 2, // status lain, message transaksi not exist
                           'message' => 'Anda belum berbelanja', 
                           'ongkir' => $this->ongkir,
                        ],
                    ], 200);
                }

                if (!is_array($transaksi)) {
                    $transaksi = json_decode($transaksi);
                }

                // validasi kuantitas
                $message = "";
                foreach($transaksi->detail_transaksis as $dt){
                
                    $barang = Barang::where('id_barang', $dt->id_barang)->first();

                    if ( (int)$barang->stok_barang - (int)$dt->kuantitas_barang < 0){
                        $message = $message.$barang->nama_barang." ";
                    }
                }

                if ($message != ""){
                    return response()->json([
                        'data' => [
                        'status' => 2, // barang habis
                        'message' => $message.' stoknya habis, harap update keranjang anda!',
                        'ongkir' => $this->ongkir,
                        ],
                    ], 200);
                }
                
                foreach($transaksi->detail_transaksis as $dt){
                
                    $barang = Barang::where('id_barang', $dt->id_barang)->first();

                    $barang->update([
                        'stok_barang' => ( (int)$barang->stok_barang - (int)$dt->kuantitas_barang )
                    ]);
                }

                $bool = Transaksi::where('id_transaksi', $request->id_transaksi)->update([
                    'status_transaksi' => 1,
                    'metode_transaksi' => $request['payment'],
                    'alamat_dikirim' => $request['address'],
                ]);;
                
                return response()->json([
                    'data' => [
                       'status' => $bool,
                       'ongkir' => $this->ongkir,
                    ],
                ], 200);
                
            }catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        } 
    }
}