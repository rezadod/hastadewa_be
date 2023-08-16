<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function tambah_stok(Request $request)
    {
        $nama_barang = $request->nama_barang;
        $harga_beli = $request->harga_beli;
        $harga_jual = $request->harga_jual;
        $jumlah_stok = $request->jumlah_stok;
        $date_now = Carbon::now('Asia/Jakarta');

        $data = [
            'nama_barang' => $nama_barang,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'jumlah_stock' => $jumlah_stok,
            'created_at' => $date_now,
            'updated_at' => $date_now
        ];

        DB::table('stocks')->insert($data);

        return redirect('tampilan_stok');
    }

    public function tampilan_stok()
    {
        $stock = DB::table('stocks')
            ->select('*')
            ->get();

        $data = [
            'stock' => $stock,
        ];

        return view('tampilan_stok', $data);
    }
}
