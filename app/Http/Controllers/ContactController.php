<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $data = [];

        // dd($data);

        return view('contact.index', compact('data'));
    }
}