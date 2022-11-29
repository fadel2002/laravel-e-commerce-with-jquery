<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use App\Models\Barang;

class ExportTransaksi implements FromView, ShouldAutoSize
{
    use \App\Http\Traits\ShopTrait;
    /**
    * @return View
    */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {   
        $data = [
            'barang' => Barang::select('id_barang', 'nama_barang', 'nama_kategori')->get(),
            'hasil' => $this->data,
        ];
        
        // dd($data );
        return view('admin.export.transaksi',compact('data'));
    }
}