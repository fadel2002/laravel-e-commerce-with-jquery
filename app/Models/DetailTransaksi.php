<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_transaksi';
    
    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'kuantitas_barang',
    ];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    } 

    public function barang(){
        return $this->hasOne(Barang::class, 'id_barang', 'id_barang');
    }  
}