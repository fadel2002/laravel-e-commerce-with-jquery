<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    
    public function index()
    {
        try {
            $data = [];

            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'admin' => $this->dataAdmin(),
                'produk' => Barang::get(),
            ];
    
            // dd($data);
            
            return view('contact.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}