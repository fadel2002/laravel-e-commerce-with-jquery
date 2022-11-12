<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;


class TesController extends Controller
{
    public function index()
    {
        $post = User::first();

        if($post->transaksis) {
            dd('this post has an author', $post->transaksis);
        } else {
            dd('this post has no author');
        }

        return view('tes');
    }
}