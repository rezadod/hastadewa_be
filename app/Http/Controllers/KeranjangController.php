<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\Providers\Auth;


class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function invoice()
    // {
    //     $jenis_satuan_ecer = DB::table('stock')
    //         ->leftJoin('items', 'stock.id', 'items.id')
    //         ->select('items.jenis_pembelian')


    //         // ->where("stock.id", '=', $id)
    //         ->get();
    //     dd($jenis_satuan_ecer);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = DB::table('transaksi')->insertGetId([
            'operator' => Auth()->id(),
        ]);
        $req = json_decode($request->keranjang, true);
        foreach ($req as $data) {

            Items::create([
                'kode_transaksi' => $id,
                'id_barang' => $data['produk_id'],
                'jumlah' => $data['kuantiti'],
                'jenis_produk' => $data['jenis_pembelian'],
            ]);
        };



        return response()->json([
            'message' => 'Data berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
