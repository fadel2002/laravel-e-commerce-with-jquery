<?php

namespace App\Http\Traits;
use App\Models\User;
use Carbon\Carbon;
use Auth;

trait AdminTrait {
    private function dataAdmin(){
        $admin = User::where('tipe_user', 2)->first();

        return [
            'id' => $admin->id_user,
            'nama' => $admin->name,
            'email' => $admin->email,
            'no_telp' => $admin->no_telp_user,
            'alamat' => 'jl demak no 28',
        ];
    }
}