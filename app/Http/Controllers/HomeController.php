<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data = [];

            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'user' => User::get(),
                'produk' => Barang::get(),
            ];
    
            // dd($data);
            
            return view('home.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}