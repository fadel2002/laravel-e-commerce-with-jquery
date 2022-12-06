<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function create(Request $request){
        $me = auth()->user()->id_user;
        $friend = $request->friend_id;
        
        $room = Room::where('users', $me.":".$friend)->orWhere('users', $friend.":".$me)->first();
        
        if ($room){
            $dataRoom = $room;
        }else {
            $dataRoom = Room::create([
                'users' => $me.":".$friend,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'room' => $dataRoom,
                'friend' => $friend,    
            ]
        ], 200);
    }
}