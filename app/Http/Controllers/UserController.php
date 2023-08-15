<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function daftar()
    {
        return view('auth.daftar');
    }

    public function masuk()
    {
        return view('login');
    }

    public function cek()
    {
        return view('layouts.master');
    }
}
