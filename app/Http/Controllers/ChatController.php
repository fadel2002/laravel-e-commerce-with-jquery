<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
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

        $data = $this->getAllBarangWithPaginate();

        return view('chat.index', compact('data'));
    }

    public function saveChat(Request $request){
        $roomId = $request->roomId;
        $userId = auth()->user()->id_user;
        $message = $request->message;

        Pesan::create([
            'room_id' => $roomId,
            'user_id' => $userId,
            'message' => $message,
        ])

        broadcast(new SendMessage($roomId, $userId, $message));
        
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil disimpan'
        ], 200);
    }

    public function loadChat($roomId){
        $message = Pesan::where('room_id', $roomId)->orderBy('updated_at', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $message
        ], 200);
    }
}