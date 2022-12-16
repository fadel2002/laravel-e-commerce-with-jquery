<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Pesan;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTransaksi;
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

    // ajax
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

    public function transaksi(){
        try {
            $data = [];
            $history_transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'user:id_user,name,no_telp_user'])->where('status_transaksi', 2)->orWhere('status_transaksi', 1)->orderByRaw("FIELD(status_transaksi, '1', '2', '0')")->orderBy('updated_at', 'desc')->paginate(4);
            
            // return response()->json([
            //     'data' => $history_transaksi,
            // ], 200);
            
            $transaksi = Transaksi::select('total_transaksi')->where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();

            if (!$transaksi) {
                $transaksi['total_transaksi'] = 0;
            }
            
            $data = [
                'admin' => $this->dataAdmin(),
                'kategori' => $this->kategori,
                'produk' => $history_transaksi,
                'total_transaksi' => $transaksi['total_transaksi'],
            ];            
            return view('admin.transaksi', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }


    // ajax
    public function moreTransaksi(){
        try {
            $data = [];
            $history_transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'user:id_user,name,no_telp_user'])->where('status_transaksi', 2)->orWhere('status_transaksi', 1)->orderByRaw("FIELD(status_transaksi, '1', '2', '0')")->orderBy('updated_at', 'desc')->paginate(4);
            
            // return response()->json([
            //     'data' => $history_transaksi,
            // ], 200);
            
            $data = [
                'produk' => $history_transaksi,
            ];          
              
            return view('admin.pagination', compact('data'))->render();
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function transaksiDetail(Request $request){
        try {
            $data = [];
            
            $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
           
            $history_transaksi = Transaksi::with(['detailTransaksis' => function($query){
                $query->orderBy('id_detail_transaksi');
                $query->select('id_detail_transaksi', 'id_transaksi', 'id_barang', 'kuantitas_barang');
            }, 'detailTransaksis.barang:id_barang,nama_barang,stok_barang,harga_barang,gambar_barang', 'user:id_user,name,email,no_telp_user'])->where('id_transaksi', $request->id)->first();
            
            if (!$transaksi) {
                $transaksi['detailTransaksis'] = [];
                $transaksi['total_transaksi'] = 0;
            }
            // return response()->json([
            //     'data' => $history_transaksi,
            // ], 200);
            
            $data = [
                'admin' => $this->dataAdmin(),
                'produk' => $transaksi,
                'histori_produk' => $history_transaksi,
                'total_transaksi' => $transaksi['total_transaksi'],
                'ongkir' => $this->ongkir,
            ];            
            return view('admin.detailTransaksi', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function productDetail($id){
        try {
            $data = [];
            
            $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
           
            $barang = Barang::where('id_barang', $id)->first();
            
            if (!$transaksi) {
                $transaksi['detailTransaksis'] = [];
                $transaksi['total_transaksi'] = 0;
            }

            // return response()->json([
            //     'admin' => $this->dataAdmin(),
            //     'produk' => $transaksi,
            //     'barang' => $barang,
            //     'total_transaksi' => $transaksi['total_transaksi'],
            //     'ongkir' => $this->ongkir,
            // ], 200);
            
            
            $data = [
                'admin' => $this->dataAdmin(),
                'kategori' => $this->kategori,
                'produk' => $transaksi,
                'barang' => $barang,
                'total_transaksi' => $transaksi['total_transaksi'],
                'ongkir' => $this->ongkir,
            ];            
            return view('admin.detailProduct', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function exportTransaksi(Request $request){

        $transaksis = Transaksi::with(['detailTransaksis:id_detail_transaksi,id_transaksi,id_barang,kuantitas_barang','detailTransaksis.barang:id_barang,harga_barang'])
            ->where('status_transaksi', 2)
            ->select('id_transaksi', 'total_transaksi')
            ->orderBy('updated_at', 'desc');

        if($request->start == null && $request->end == null ){
            $transaksis = $transaksis->get();
        }else if ($request->start != null && $request->end == null){
            $transaksis = $transaksis
                ->whereDate('updated_at', '>=', $request->start)
                ->get();
        }else if ($request->start == null && $request->end != null){
            $transaksis = $transaksis
                ->whereDate('updated_at', '<=', $request->end)
                ->get();
        }else {
            $transaksis = $transaksis->whereDate('updated_at', '>=', $request->start)
                ->whereDate('updated_at', '<=', $request->end)
                ->get();
        }

        $barangs = Barang::select('id_barang', 'nama_barang', 'stok_barang', 'harga_barang')->get();

        $data_hasil = [];

        $total_pemasukan = 0;
        $total_item_terjual = 0;

        foreach($barangs as $barang){
            $barang_terjual[(int)$barang->id_barang] = 0;
            $harga_barang_terjual[(int)$barang->id_barang] = 0;
        }

        // $data_cross_check_total = 0; // debug variable

        foreach ($transaksis as $transaksi){
            $total_pemasukan += (int)$transaksi->total_transaksi;
            if (!is_array($transaksi)) {
                $transaksi = json_decode($transaksi);
            }
            foreach($transaksi->detail_transaksis as $dt){
                $barang_terjual[$dt->id_barang] += (int)$dt->kuantitas_barang;
                $total_item_terjual += (int)$dt->kuantitas_barang;
                $harga_barang_terjual[$dt->id_barang] += ( (int)$dt->barang->harga_barang * (int)$dt->kuantitas_barang ) ;
                // $data_cross_check_total += ( (int)$dt->barang->harga_barang * (int)$dt->kuantitas_barang ); // debug variable
            }

            // $data_cross_check_total += $this->ongkir; // debug variable
        }

        $data_hasil = [
            'total_item_terjual' => $total_item_terjual,
            'total_pemasukan' => $total_pemasukan,
            'barang_terjual' => $barang_terjual,
            'harga_barang_terjual' => $harga_barang_terjual,
            'start' => $request->start,
            'end' => $request->end,
        ];

        // debug variable
        // if ($total_pemasukan != $data_cross_check_total){
        //     \Alert::warning('Failed', "Failed To Download Excel [CrossCheck " . $data_cross_check_total . "] [Actual " . $total_pemasukan . "]");
        //     return redirect()->back();
        // }

        return Excel::download(new ExportTransaksi($data_hasil), 'export-transaksi.xlsx');
    }

    public function getUserLocation(Request $request){
        $loc = Transaksi::where('id_transaksi', $request->id_transaksi)->select('latitude', 'longitude')->first();
        return response()->json([
            'status' => 200,
            'location' => $loc,
        ], 200);   
    }

    /* Post Put and Delete Method */
    // ajax
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

                if (file_exists(public_path()."/".$barang->gambar_barang)){
                    \File::delete(public_path()."/".$barang->gambar_barang);
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

    // ajax
    public function createProduct(Request $request){
        if ($request->ajax()){
            try {
                $validator = Validator::make($request->all(), [
                    'kategori' => 'required',
                    'nama' => 'required',
                    'price' => 'required|numeric',
                    'berat' => 'required|numeric',
                    'stok' => 'required|numeric',
                    'deskripsi' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:4196',
                ]);
            
                if ($validator->passes()) {

                    if ($request->hasFile('image')) {
                        $image = time().'.'.$request->image->extension();
                        $request->image->move(public_path('images/products'), $image);
                    }

                    $barang = Barang::create([
                        'nama_barang' => $request->nama,
                        'stok_barang' => $request->stok,
                        'harga_barang' => $request->price,
                        'deskripsi_barang' => $request->deskripsi,
                        'nama_kategori' => $request->kategori,
                        'gambar_barang' => 'images/products/'.$image,
                        'berat_barang' => $request->berat,
                    ]);

                    return response()->json(['status'=> 200, 'barang' => $barang]);
                }
            
                return response()->json(['error'=>$validator->errors()->all()]);    
            }catch (ModelNotFoundException $exception) {
                
                return back()->withError($exception->getMessage())->withInput();
            }
        }
    }

        // ajax
        public function updateProduct(Request $request){
            if ($request->ajax()){
                try {
                    $validator = Validator::make($request->all(), [
                        'id_barang' => 'required',
                        'kategori' => 'required',
                        'nama' => 'required',
                        'price' => 'required|numeric',
                        'berat' => 'required|numeric',
                        'stok' => 'required|numeric',
                        'deskripsi' => 'required',
                    ]);

                    $boolImage = null;
                    
                    if ($request->hasFile('image')){
                        $imageValid = Validator::make($request->all(), [
                            'image' => 'image|mimes:jpeg,png,jpg|max:4196',
                        ]);
                        if (!$imageValid->passes()){
                            return response()->json(['error'=>$imageValid->errors()->all()]); 
                        }

                        $barang = Barang::where('id_barang', $request->id_barang)->first();
                        
                        if (file_exists(public_path()."/".$barang->gambar_barang)){
                            \File::delete(public_path()."/".$barang->gambar_barang);
                        }

                        $image = time().'.'.$request->image->extension();
                        $request->image->move(public_path('images/products'), $image);
                        // return response()->json(['status'=> 200, 'status_update' => $request->all()]);
                        $boolImage = Barang::where('id_barang', $request->id_barang)->update([
                            'gambar_barang' => 'images/products/'.$image,
                        ]);
                    }
                    
                    if ($validator->passes()) {
                        
                        $bool = Barang::where('id_barang', $request->id_barang)->update([
                            'nama_barang' => $request->nama,
                            'stok_barang' => $request->stok,
                            'harga_barang' => $request->price,
                            'deskripsi_barang' => $request->deskripsi,
                            'nama_kategori' => $request->kategori,
                            'berat_barang' => $request->berat,
                        ]);

                        $barang = Barang::where('id_barang', $request->id_barang)->first();
                        
                        return response()->json(['status'=> 200, 'status_update' => $barang, 'img_update_status' => $boolImage]);
                    }
                
                    return response()->json(['error'=>$validator->errors()->all()]);    
                }catch (ModelNotFoundException $exception) {
                    
                    return back()->withError($exception->getMessage())->withInput();
                }
            }
        }

    // ajax
    public function changeStatusDone(Request $request){
        if ($request->ajax()){
            try {
                $data = [];
                
                $transaksi = Transaksi::where('id_transaksi', $request->id_transaksi)->first();

                $banyakTransaksi = count(Transaksi::where([['id_user', $transaksi->id_user],['status_transaksi', 1]])->get());

                if($banyakTransaksi == 1){
                    $room = Pesan::where('id_user', $transaksi->id_user)->first();
                    if($room) Pesan::where('id_room', $room->id_room)->delete();
                }

                $bool = Transaksi::where([['id_transaksi', $request->id_transaksi],['status_transaksi', 1]])->update([
                    'status_transaksi' => 2,
                ]);

                return response()->json([
                    'status' => $bool,
                ], 200);
                
            }catch (ModelNotFoundException $exception) {
                
                return back()->withError($exception->getMessage())->withInput();
            }
        }
    }
}