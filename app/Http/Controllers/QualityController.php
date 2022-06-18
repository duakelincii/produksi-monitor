<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Product;
use App\QualityControl;
use App\Qualitydetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualityController extends Controller
{

    public function index()
    {
        $datas = QualityControl::get();
        return view('qualitycontrol.index',compact('datas'));
    }

    public function status($id)
    {
        $datas = QualityControl::where('id',$id)->get();
        return view('qualitycontrol.status',compact('datas'));
    }

    public function create()
    {
        $datas = Pesanan::where('status' , 'proses')->get();
        return view('qualitycontrol.create',compact('datas'));
    }

    public function proses(Request $request)
    {
        $items = $request->get('items');
        dd($items);
    }

    public function status_update(Request $request)
    {
        QualityControl::updateOrCreate(
            [
                'id_pesanan' => $request->id_pesanan
            ],[
                'id_product'    => $request->id_product,
                'status'    => $request->status,
                'created_at'    => Carbon::now(),
            ]
        );
            Pesanan::where('id',$request->id_pesanan)->update(['status' => $request->status]);
            $pesan ='Update Proses Pesanan Berhasil...!!!';
            return redirect(route('quality'))->with('pesan',$pesan);

    }

    public function input_barang($id)
    {
            $datas = QualityControl::where('id',$id)->get();
            $pesanans = Pesanan::get();
            $products = Product::get();
            return view('qualitycontrol.input',compact('datas','products','pesanans'));
    }

    public function store(Request $request)
    {
       DB::beginTransaction();
       try {
        QualityControl::where('id',$request->id)->update([
            'id_pesanan'    => $request->id_pesanan,
            'id_product'    => $request->id_product,
            'barang_ready'    => $request->barang_ready,
            'barang_rusak'    => $request->barang_rusak,
            'ket'    => $request->keterangan,
            'status'        => 'selesai',
        ]);

        $dt_produk = Product::where('id', $request->id_product)->first();
        $kurangi_stok = $dt_produk->stock - $request->barang_ready;
        $harga = Pesanan::where('id',$request->id_pesanan)->update([
            'barang_ready'  => $request->barang_ready,
            'harga_total'   => $request->barang_ready * $dt_produk->harga_jual,
            'status' => 'siap kirim'
        ]);

        if($kurangi_stok == 0){
            Product::where('id',$request->id_product)->update([
                'stock' => $kurangi_stok,
                'status' => 'sold'
            ]);
        }
            DB::commit();
        $pesan = 'Barang Sudah Berhasil Melewati Proses Quality Control....!!!';
        return redirect(route('quality'))->with('pesan',$pesan);
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
