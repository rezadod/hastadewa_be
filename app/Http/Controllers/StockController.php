<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Decoder;
use Lcobucci\JWT\Encoder;
use PhpParser\JsonDecoder;

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
            ->where("toko_id", '=', $user)
            ->get();

        $data = [
            'data_stock' => $stock
        ];

        return response()->json($data, 200);
    }

    public function data_satuan()
    {
        $ecer = DB::table('satuan_ecer')
            ->get();
        $grosir = DB::table('satuan_grosir')
            ->get();

        $data = [
            'satuan_ecer' => $ecer,
            'satuan_grosir' => $grosir
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
        $user = Auth::user()->toko_id;

        if (Stock::where('nama_produk', $request->nama_produk)->where('toko_id', $user)->exists()) {
            return response()->json([
                'message' => 'Data barang sudah ada',
            ], 400);
        } else {
            $validator = Validator::make(request()->all(), [
                'nama_produk' => 'required',
                'harga_beli' => 'required',
                'kuantiti' => 'required',
                'isi_per_pack' => 'required',
                'harga_grosir' => 'required',
                'harga_ecer' => 'required',

            ]);
            Stock::create([
                'nama_produk' => request('nama_produk'),
                'harga_beli' => request('harga_beli'),
                'kuantiti' => request('kuantiti'),
                'isi_per_pack' => request('isi_per_pack'),
                'harga_grosir' => request('harga_grosir'),
                'harga_ecer' => request('harga_ecer'),
                'satuan_grosir' => request('satuan_grosir'),
                'satuan_ecer' => request('satuan_ecer'),
                'toko_id' => Auth::user()->toko_id,
                'username_input' => Auth::user()->id,
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->messages());
        }
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
    public function detailKasir(Request $request)
    {


        $id = $request->query('id');

        // $jenis_satuan_ecer = DB::table('stock')
        //     ->leftJoin('satuan_ecer', 'stock.satuan_ecer', 'satuan_ecer.id')
        //     ->select('satuan_ecer.nama_satuan')
        //     ->where("stock.id", '=', $id)
        //     ->first();

        // dd($jenis_satuan_ecer->nama_satuan);

        // dd($jenis_satuan);
        $harga = DB::table('stock')
            ->select('harga_grosir', 'harga_ecer')
            ->first();

        $data_jenis = '[{"id":1,"satuan":"Ecer","harga":' . $harga->harga_grosir . '},{"id":2,"satuan":"Grosir","harga":' . $harga->harga_ecer . '}]';
        $convert = json_decode($data_jenis);
        $stock = DB::table('stock')
            ->where("stock.id", '=', $id)
            ->leftJoin('satuan_ecer', 'stock.satuan_ecer', 'satuan_ecer.id')
            ->select('satuan_ecer.nama_satuan', 'stock.*')
            ->first();
        $data = [
            'data_stock' => $stock,
            'satuan' => $convert
        ];

        return response()->json($data,  200);
    }

    public function report_penjualan(Request $request)
    {

        $data_toko = DB::table('toko')
            ->select('*')
            ->get();

        $data = [
            'data_toko' => $data_toko
        ];


        return view('report_toko', $data);
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
