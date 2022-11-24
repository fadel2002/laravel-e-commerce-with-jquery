<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Auth;

class ContactController extends Controller
{
    use \App\Http\Traits\AdminTrait;
    
    public function index()
    {
        try {
            $data = [];
            $transaksi = Transaksi::where([['status_transaksi', 0],['id_user', Auth::user()->id_user]])->first();
            if (!$transaksi){
                $transaksi['total_transaksi'] = 0;
            }
            $data = [
                'kategori' => ['Food', 'Drink', 'Cigar'],
                'admin' => $this->dataAdmin(),
                'produk' => Barang::get(),
                'total_transaksi' => $transaksi['total_transaksi'],
            ];
    
            // dd($data);
            
            return view('contact.index', compact('data'));
            
        }catch (ModelNotFoundException $exception) {
            
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}