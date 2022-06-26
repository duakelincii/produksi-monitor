<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Product;
use App\QualityControl;
use App\Qualitydetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class QualityController extends Controller
{

    public function index()
    {
        $datas = Pesanan::get();
        return view('qualitycontrol.index',compact('datas'));
    }

    public function status($id)
    {
        $datas = Pesanan::where('id',$id)->get();
        return view('qualitycontrol.status',compact('datas'));
    }

    public function create()
    {
        $datas = Pesanan::where('status' , 'proses')->get();
        return view('qualitycontrol.create',compact('datas'));
    }

    public function proses($id)
    {
        $data = Pesanan::where('id',$id);
        $data->update([
            'status' => 'cuting'
        ]);
        Alert::success('Success','Quality Control Berhasil Dibuat');
        return redirect(route('quality'));
    }

    public function status_update(Request $request)
    {
            Pesanan::where('id',$request->id)->update([
                'status' => $request->status
            ]);
            $pesan ='Update Proses Pesanan Berhasil...!!!';
            return redirect(route('quality'))->with('pesan',$pesan);

    }

    public function input_barang($id)
    {
            $datas = Pesanan::where('id',$id)->get();
            $products = Product::get();
            return view('qualitycontrol.input',compact('datas','products'));
    }

    public function store(Request $request)
    {
       DB::beginTransaction();
       try {
        QualityControl::insert([
            'id_pesanan'    => $request->id,
            'id_product'    => $request->id_product,
            'barang_ready'    => $request->barang_ready,
            'barang_rusak'    => $request->barang_rusak,
            'ket'           => $request->keterangan,
            'created_at' => Carbon::now()
        ]);

        $dt_produk = Product::where('id', $request->id_product)->first();
        $kurangi_stok = $dt_produk->stock - $request->barang_ready;
        Pesanan::where('id',$request->id)->update([
            'barang_ready'  => $request->barang_ready,
            'harga_total'   => $request->barang_ready * $dt_produk->harga_jual,
            'status' => 'siap kirim'
        ]);
            DB::commit();
            Alert::success('Success','Barang Sudah Berhasil Melewati Proses Quality Control....!!!');
        return redirect(route('quality'));
       } catch (\Throwable $th) {
           DB::rollback();
            throw $th;
       }
    }

    public function edit($id)
    {
        return view('qualitycontrol.edit');
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($id)
    {
        $data = QualityControl::findOrFail($id);
        $data->delete();
        $pesan = 'Data Berhasil Dihapus...!!!';
        return redirect(route('quality'))->with('error',$pesan);
    }
}
