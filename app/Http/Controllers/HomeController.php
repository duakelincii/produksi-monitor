<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlah['order_baru'] = Pesanan::where('status', 'order baru')->count();
        $jumlah['proses'] = Pesanan::where('status', 'proses')->count();
        $jumlah['siap_kirim'] = Pesanan::where('status', 'siap kirim')->count();
        $jumlah['selesai'] = Pesanan::where('status', 'selesai')->count();

        $bulan = Pesanan::select(DB::raw("MONTHNAME(tgl_pesan) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(tgl_pesan)"))
            ->pluck('bulan');

        $datas = Product::all();

        $pendapatan = Pesanan::select(DB::raw("CAST(SUM(harga_total) AS UNSIGNED INTEGER ) as harga_total"))
            ->GroupBy(DB::raw("Month(tgl_pesan)"))
            ->pluck('harga_total');
        // dd($pendapatan);
        return view('home', compact('jumlah','bulan','pendapatan' ));
    }
}
