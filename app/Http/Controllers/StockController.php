<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->toko_id;
        $stock = DB::table('stock')
            ->select('*')
            ->where("user_name_input", $user)
            ->get();

        $data = [
            'data_stock' => $stock
        ];

        return response()->json($data, 200);
    }

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
        $validator = Validator::make(request()->all(), [
            'nama_produk' => 'required',
            'harga_beli' => 'required',
            'kuantiti' => 'required',
            'isi_per_pack' => 'required',
            'harga_per_pcs' => 'required',
            'harga_per_pack' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        Stock::create([
            'nama_produk' => request('nama_produk'),
            'harga_beli' => request('harga_beli'),
            'kuantiti' => request('kuantiti'),
            'isi_per_pack' => request('isi_per_pack'),
            'harga_per_pcs' => request('harga_per_pcs'),
            'harga_per_pack' => request('harga_per_pack'),
            'user_name_input' => Auth::user()->toko_id,
        ]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->query('id');

        Stock::whereId($id)->update([
            'kuantiti' => request('kuantiti'),
        ]);
        // Stock::whereId($id)([
        //     'id'=>$id,
        //     'nama_produk' => request('nama_produk'),
        //     'harga_beli' => request('harga_beli'),
        //     'isi_per_pack' => request('isi_per_pack'),
        //     'harga_per_pcs' => request('harga_per_pcs'),
        //     'harga_per_pack' => request('harga_per_pack'),
        //     'user_name_input' => Auth::user()->toko_id,
        // ]);
        return response()->json([
            'message' => 'Data berhasil DIUBAH',
        ]);
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
