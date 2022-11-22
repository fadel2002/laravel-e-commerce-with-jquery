<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TesController extends Controller
{
    public function index()
    {
        DetailTransaksi::create([
            'id_transaksi' => 1,
            'id_barang' => 2,
            'kuantitas_barang' => 3,
        ]);

        return view('tes');
    }
}