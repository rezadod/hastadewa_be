<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use Exception;
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
    public function index(Request $request)
    {
        $user = Auth::user()->toko_id;

        $keyword = $request->keyword;
        $page = $request->page;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $stock = DB::table('stock')
            // ->where("toko_id", '=', $user)
            ->where('nama_produk', 'like', '%' . $keyword . '%')
            ->limit($limit)
            ->offset($offset)
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
                'user_name_input' => Auth::user()->id,
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

        $harga = DB::table('stock')
            ->select('harga_grosir', 'harga_ecer')
            ->first();


        $stock = DB::table('stock')
            ->where("stock.id", '=', $id)
            ->leftJoin('satuan_ecer', 'stock.satuan_ecer', 'satuan_ecer.id')
            ->select('satuan_ecer.nama_satuan', 'stock.*')
            ->first();
        $data_jenis = '[{"id":1,"satuan":"Ecer","harga":' . $stock->harga_grosir . '},{"id":2,"satuan":"Grosir","harga":' . $stock->harga_ecer . '}]';
        $convert = json_decode($data_jenis);
        $data = [
            'data_stock' => $stock,
            'satuan' => $convert
        ];

        return response()->json($data,  200);
    }

    public function report_penjualan(Request $request)
    {

        $data_penjualan = DB::table('transaksi as a')
            ->leftJoin('items as b', 'a.id', 'b.kode_transaksi')
            ->leftJoin('stock as c', 'b.id_barang', 'c.id')
            ->select(
                'a.id as invoice',
                'a.created_at as tanggal',
                DB::raw('SUM(CASE
                                    WHEN b.jenis_pembelian = 1 THEN (b.jumlah * c.harga_ecer)
                                    WHEN b.jenis_pembelian = 2 THEN (b.jumlah * c.harga_grosir)
                            ELSE 0 END) as harga_total')
            )
            ->groupBy('a.id')
            ->get();
        // dd($data_penjualan);
        $data_toko = DB::table('toko')
            ->select('*')
            ->get();

        $data = [
            'data_toko' => $data_toko,
            'data_penjualan' => $data_penjualan,
        ];


        return view('report_toko', $data);
    }

    public function report_penjualan_detail(Request $request)
    {
        try {
            $data_detail = DB::table('items as a')
                ->leftJoin('stock as b', 'a.id_barang', 'b.id')
                ->leftJoin('jenis_pembelian as c', 'a.jenis_pembelian', 'c.id')
                ->leftJoin('transaksi as d', 'a.kode_transaksi', 'd.id')
                ->leftJoin('users as e', 'd.operator', 'e.id')
                ->select(
                    'a.id_barang',
                    'a.id as items_id',
                    'a.jumlah',
                    'a.kode_transaksi',
                    'b.nama_produk',
                    'c.deskripsi as jenis_pembelian',
                    'e.username as username_op'
                )
                ->where('a.kode_transaksi', $request->invoice)
                ->get();

            $data = [
                'data_detail' => $data_detail,
            ];


            return view('report_toko_detail', $data);
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function report_penjualan_tampil(Request $request)
    {
        try {
            $tanggal_1 = $request->tanggal_1;
            $tanggal_2 = $request->tanggal_2;

            $data_penjualan = DB::table('transaksi as a')
                ->leftJoin('items as b', 'a.id', 'b.kode_transaksi')
                ->leftJoin('stock as c', 'b.id_barang', 'c.id')
                ->select(
                    'a.id as invoice',
                    'a.created_at as tanggal',
                    DB::raw('SUM(CASE
                                    WHEN b.jenis_pembelian = 1 THEN (b.jumlah * c.harga_ecer)
                                    WHEN b.jenis_pembelian = 2 THEN (b.jumlah * c.harga_grosir)
                            ELSE 0 END) as harga_total')
                )
                ->whereDate('a.created_at', '>=', $tanggal_1)
                ->whereDate('a.created_at', '<=', $tanggal_2)
                ->groupBy('a.id')
                ->get();

            $data = [
                'data_penjualan' => $data_penjualan,
            ];


            return view('report_toko_tampil', $data);
        } catch (Exception $e) {
            dd($e);
        }
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
