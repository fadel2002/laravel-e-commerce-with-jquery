<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $data = [];

        $data = [
            'kategori' => ['Food', 'Drink', 'Cigar'],
            'user' => User::get(),
            'produk' => Barang::get(),
        ];

        // dd($data);

        return view('shop.index', compact('data'));
    }
}