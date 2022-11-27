<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AdminController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    use \App\Http\Traits\ShopTrait;

    public function index(){
        try {
            $data = [];
            $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
            if (!$transaksi){
                $transaksi['total_transaksi'] = 0;
            }

            $barang = Barang::get();

            // return response()->json([
            //     'data' =>  $barang,
            // ], 200);
            
            $data = [
                'kategori' => $this->kategori,
                'admin' => $this->dataAdmin(),
                'produk' => $barang,
                'total_transaksi' => $transaksi['total_transaksi'],
            ];
            
            return view('admin.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function moreData(){
        try {
            $data = [];

            $data = [
                'produk' => Barang::paginate(10),
            ];
            
            return view('admin.pagination', compact('data'))->render();
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    
    public function delete(Request $request){
        if ($request->ajax()){
            try {
                $barang = Barang::where('id_barang', $request->id_barang)->first();
                $dts = DetailTransaksi::where('id_barang', $request->id_barang)->get();

                // return response()->json([
                //     'status' => [
                //         'trans' => $dts,
                //     ],
                // ], 200); 

                foreach($dts as $dt){
                    $transaksi = Transaksi::where('id_transaksi', $dt->id_transaksi)->first();

                    $transaksi->update([
                        'total_transaksi' => (int)$transaksi->total_transaksi - ((int)$dt->kuantitas_barang * (int)$barang->harga_barang),
                    ]);
                }

                $bool_b = Barang::where('id_barang', $request->id_barang)->delete();
                $bool_dt = DetailTransaksi::where('id_barang', $request->id_barang)->delete();
                
                return response()->json([
                    'status' => [
                        'hapus_barang' => $bool_b,
                        'hapus_detail_transaksi' => $bool_dt,
                    ],
                ], 200);       
            }catch (ModelNotFoundException $exception) {
                
                return back()->withError($exception->getMessage())->withInput();
            }
        }
    }
}