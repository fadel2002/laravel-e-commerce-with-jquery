<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Auth;

class HistoryController extends Controller
{

    use \App\Http\Traits\AdminTrait;
    use \App\Http\Traits\ShopTrait;
    
    public function index(){
        try {
            $data = [];
            $history_transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'detailTransaksis.barang:id_barang,gambar_barang'])->where([['status_transaksi', 2],['id_user', Auth::user()->id_user]])->get();
            
            $transaksi = Transaksi::select('total_transaksi')->where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();

            if (!$transaksi) {
                $transaksi['total_transaksi'] = 0;
            }

            // foreach($history_transaksi as $barang){

            //     if (!is_array($barang)) {
            //         $barang = json_decode($barang);
            //     }
                
            //     foreach($barang->detail_transaksis as $barang_lagi){
            //         return response()->json([
            //             'admin' => $barang_lagi,
            //             'data' => $barang_lagi->barang->gambar_barang,
            //         ], 200);
            //     }
            // }
            
            // return response()->json([
            //     'admin' => $this->dataAdmin(),
            //     'kategori' => $this->kategori,
            //     'produk' => $history_transaksi,
            //     'total_transaksi' => $transaksi['total_transaksi'],
            // ], 200);
            
            $data = [
                'admin' => $this->dataAdmin(),
                'kategori' => $this->kategori,
                'produk' => $history_transaksi,
                'total_transaksi' => $transaksi['total_transaksi'],
            ];            
            return view('history.index', compact('data'));
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function detail(Request $request){
        try {
            $data = [];
            
            $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
           
            $history_transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'detailTransaksis.barang:id_barang,nama_barang,stok_barang,harga_barang,gambar_barang'])->where([['status_transaksi', 2],['id_transaksi', $request->id],['id_user', Auth::user()->id_user]])->first();
            
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
                'histori_produk' => $history_transaksi,
                'total_transaksi' => $transaksi['total_transaksi'],
                'ongkir' => $this->ongkir,
            ];            
            return view('history.detail', compact('data'));
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

}