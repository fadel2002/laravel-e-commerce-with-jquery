<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use \App\Http\Traits\AdminTrait;

    public function index()
    {
        try {
            $data = [];

            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'admin' => $this->dataAdmin(),
                'user' => User::get(),
                'produk' => Barang::orderBy('harga_barang', 'desc')->limit(8)->get(),
            ];
    
            // dd($data);
            
            return view('home.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}