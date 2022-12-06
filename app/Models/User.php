<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'id_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tipe_user', // 1 user, 2 admin
        'no_telp_user',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transaksis(){
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }  

    public function canJoinRoom($roomId){
        $granted = false;

        $room = Room::findOrFail($roomId);
        $users = explode(":", $room->users);
        foreach($users as $id){
            if ($this->id_user == $id){
                $granted = true;
            }
        }
        return $granted;
    }

    public function pesans(){
        return $this->hasMany(Pesan::class, 'id_user', 'id_user');
    }
}