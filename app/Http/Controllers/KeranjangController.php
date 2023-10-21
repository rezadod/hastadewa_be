<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
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
        DB::beginTransaction();
        try {
            $date_now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            // $id = 1;

            $data_op = DB::table('users')->where('id', Auth()->id())->first();

            $id = DB::table('transaksi')->insertGetId([
                'operator' => Auth()->id(),
            ]);
            $req = json_decode($request->keranjang, true);
            foreach ($req as $data) {

                Items::create([
                    'kode_transaksi' => $id,
                    'id_barang' => $data['produk_id'],
                    'jumlah' => $data['kuantiti'],
                    'jenis_pembelian' => $data['jenis_pembelian'],
                ]);

                // get total kuantiti
                $produk = DB::table('stock')->select('kuantiti', 'nama_produk')->where('id', $data['produk_id'])->first();

                if ($produk->kuantiti < $data['kuantiti']) {
                    $data = [
                        'message' => "Stock " . $produk->nama_produk . " tersisa " . $produk->kuantiti,
                    ];
                    DB::rollBack();
                    return response()->json($data, 500);
                }

                $sisa_qty = intval($produk->kuantiti) - intval($data['kuantiti']);

                // update kuantiti

                DB::table('stock')->where('id', $data['produk_id'])->update(['kuantiti' => $sisa_qty]);
            };
            DB::commit();

            $data_invoice = DB::table('items as a')
                ->leftJoin('stock as b', 'a.id_barang', 'b.id')
                ->leftJoin('jenis_pembelian as c', 'a.jenis_pembelian', 'c.id')
                ->leftJoin('satuan_grosir as s_gs', 'b.satuan_grosir', 's_gs.id')
                ->leftJoin('satuan_ecer as s_ec', 'b.satuan_ecer', 's_ec.id')
                ->select(
                    'a.id',
                    'b.nama_produk as nama_barang',
                    'a.jumlah as kuantiti',
                    'c.deskripsi as jenis_pembelian',
                    DB::raw('(CASE
                                    WHEN a.jenis_pembelian = 1 THEN s_ec.nama_satuan
                                    WHEN a.jenis_pembelian = 2 THEN s_gs.nama_satuan
                            ELSE 0 END) as satuan')
                )
                ->where('kode_transaksi', $id)
                ->get();

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
                ->where('a.id', $id)
                ->groupBy('a.id')
                ->get();

            $total_harga = 0;
            foreach ($data_penjualan as $row) {
                $total_harga += $row->harga_total;
            }

            $data = [
                'id' => $id,
                'invoice' => $data_invoice,
                'total_harga' => $total_harga,
                'nama_kasir' => $data_op->username,
                'tanggal_transaksi' => $date_now,
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];

            return response()->json($data, 200);
        }
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
