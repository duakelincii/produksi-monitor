<?php

namespace App\Http\Controllers;

use App\Pengiriman;
use App\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Pengiriman::get();
        return view('pengiriman.index', compact('datas'));
    }

    public function create()
    {
        $items = Pesanan::where('status', 'siap kirim')->orderBy('status')->get();
        return view('pengiriman.create', compact('items'));
    }

    public function create_id($id)
    {
        $items = Pesanan::where('id', $id)->get();
        return view('pengiriman.input', compact('items'));
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
                $datas = pengiriman::insert([
                    'id_customer'   => $request->id_customer,
                    'id_pesanan'   => $request->id_pesanan,
                    'tgl_kirim'   => $request->tgl_kirim,
                    'nama_supir'   => $request->nama_supir,
                    'no_kendaraan'   => $request->no_kendaraan,
                    'created_at' => Carbon::now()
                ]);
                Pesanan::where('id', $request->id)->update([
                    'status' => 'terkirim',
                ]);
                DB::commit();
                $pesan = 'Data pengiriman Berhasil Di Input...!!!';
                return redirect(route('pengiriman'))->with('pesan', $pesan);
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
    }

    public function update(Request $request)
    {
        $datas = pengiriman::where('id',$request->id)->update([
            'id_customer'   => $request->id_customer,
            'id_pesanan'   => $request->id_pesanan,
            'tgl_jalan'   => $request->tgl_jalan,
            'nama_supir'   => $request->nama_supir,
            'no_kendaraan'   => $request->no_kendaraan,
            'updated_at' => Carbon::now()
        ]);
        Pesanan::where('id', $request->id)->update([
            'status' => 'terkirim',
        ]);
        $pesan = 'Data pengiriman Berhasil Di Update...!!!';
        return redirect(route('pengiriman'))->with('pesan', $pesan);
    }

    public function surat_jalan($id)
    {
        $datas = Pengiriman::findOrFail($id);
        $sj = "SJ-" .rand();
        $pdf = PDF::loadView('pdf.suratjalan',compact('datas','sj'))->setPaper('A4','potrait');
        return $pdf->stream();
    }
}
