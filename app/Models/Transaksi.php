<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'metode_transaksi',
        'total_transaksi',
        'status_transaksi',
        'alamat_dikirim',
        'id_user',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detailTransaksis(){
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }  
}