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

class ReportController extends Controller
{
    public function report(Request $request)
    {
        try {
            $date_now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $year_now = Carbon::now('Asia/Jakarta')->format('Y');
            $month_now = Carbon::now('Asia/Jakarta')->format('m');
            $week_now = Carbon::now('Asia/Jakarta')->format('W');

            $array_report = [];
            $array_grafik = [];
            $array_last_transaction = [];
            $array_stock = [];

            // isian report
            $data_hari_ini = DB::table('transaksi as a')
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
                ->whereDate('a.created_at', $date_now)
                ->get();

            $data_minggu_ini = DB::table('transaksi as a')
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
                ->where(DB::raw('WEEK(a.created_at)'), $week_now)
                ->get();

            $data_bulan_ini = DB::table('transaksi as a')
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
                ->whereYear('a.created_at', $year_now)
                ->whereMonth('a.created_at', $month_now)
                ->get();

            array_push(
                $array_report,
                array(
                    'id' => 1,
                    'report' => 'Hari Ini',
                    'jumlah' => $data_hari_ini[0]->harga_total
                ),
                array(
                    'id' => 1,
                    'report' => 'Minggu Ini',
                    'jumlah' => $data_minggu_ini[0]->harga_total
                ),
                array(
                    'id' => 1,
                    'report' => 'Bulan Ini',
                    'jumlah' => $data_bulan_ini[0]->harga_total
                )
            );

            // isian grafik
            $data_grafik_minggu_ini = DB::table('transaksi as a')
                ->leftJoin('items as b', 'a.id', 'b.kode_transaksi')
                ->leftJoin('stock as c', 'b.id_barang', 'c.id')
                ->select(
                    'a.id as invoice',
                    DB::raw('DATE(a.created_at) as tanggal'),
                    DB::raw('SUM(CASE
                                    WHEN b.jenis_pembelian = 1 THEN (b.jumlah * c.harga_ecer)
                                    WHEN b.jenis_pembelian = 2 THEN (b.jumlah * c.harga_grosir)
                            ELSE 0 END) as harga_total')
                )
                ->where(DB::raw('WEEK(a.created_at)'), $week_now)
                ->groupBy(DB::raw('DATE(a.created_at)'))
                ->get();

            foreach ($data_grafik_minggu_ini as $row) {
                array_push(
                    $array_grafik,
                    array(
                        'x' => $row->tanggal,
                        'y' => $row->harga_total
                    )
                );
            }

            // last transaction
            $data_last_transaction = DB::table('transaksi as a')
                ->leftJoin('items as b', 'a.id', 'b.kode_transaksi')
                ->leftJoin('stock as c', 'b.id_barang', 'c.id')
                ->leftJoin('users as d', 'a.operator', 'd.id')
                ->select(
                    'd.username',
                    // 'a.id as invoice',
                    DB::raw('DATE(a.created_at) as tanggal'),
                    DB::raw('SUM(CASE
                                    WHEN b.jenis_pembelian = 1 THEN (b.jumlah * c.harga_ecer)
                                    WHEN b.jenis_pembelian = 2 THEN (b.jumlah * c.harga_grosir)
                            ELSE 0 END) as harga_total')
                )
                ->orderBy('a.created_at', 'DESC')
                ->groupBy('a.id')
                ->limit(1)
                ->first();
            $data = [
                'report' => $array_report,
                'grafik' => $array_grafik,
                'last_transaction' => $data_last_transaction,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];

            return response()->json($data, 400);
        }
    }
}
