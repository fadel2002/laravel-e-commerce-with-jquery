<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pesan;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class ChatController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    use \App\Http\Traits\ShopTrait;
    
    public function index(){
        $data = [];

        $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
        if (!$transaksi){
            $transaksi['total_transaksi'] = 0;
        }
        
        $data = [
            'kategori' => $this->kategori,
            'admin' => $this->dataAdmin(),
            'total_transaksi' => $transaksi['total_transaksi'],
        ];

        if (auth()->user()->tipe_user == 2){
            $data['transaksis'] = Transaksi::with('user:id_user,name,no_telp_user')->groupBy('id_user')->where('status_transaksi', 1)->get();
            // return response()->json($data, 200);
            return view('admin.chat', compact('data'));
        }else {
            $data['transaksi'] = Transaksi::with('user:id_user,name,no_telp_user')->groupBy('id_user')->where([['status_transaksi', 1], ['id_user', Auth::user()->id_user]])->first();
            
            // return response()->json($data, 200);
            return view('chat.index', compact('data'));
        }
    }

    public function saveChat(Request $request){
        $roomId = $request->roomId;
        $userId = auth()->user()->id_user;
        $message = $request->message;

        // return response()->json([
        //     'success' => true,
        //     'message' => [
        //         'id' => $roomId,
        //         'message' => $message
        //     ]
        // ], 200);
        
        // broadcast(new \App\Events\SendMessage($roomId, $userId, $message));
        broadcast(new \App\Events\SendMessage($roomId, $userId, $message))->toOthers();
        
        $pesan = Pesan::create([
            'id_room' => $roomId,
            'id_user' => $userId,
            'message' => $message,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => $pesan
        ], 200);
    }

    public function loadChat($roomId){
        $message = Pesan::where('id_room', $roomId)->orderBy('updated_at', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $message
        ], 200);
    }
}