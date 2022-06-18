<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Paket;
use App\Payment;
use App\Pesanan;
use App\Pesenandetails;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PesananController extends Controller
{

    public function index()
    {
        $datas = Pesanan::get();
        return view('pesanan.index',compact('datas'));
    }

    public function create()
    {
        $kode = 'OR-'.rand();
        $customers = Customer::get();
        $products = Product::get();
        $pakets = Paket::get();
        return view('pesanan.create',compact('kode','customers','products','pakets'));
    }

    public function detail($id)
    {
        $datas = Pesanan::where('id',$id)->get();
        return view('pesanan.detail',compact('datas'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $pesanan = new Pesanan;
            $pesanan->id_product = $data['id_product'];
            $pesanan->quantity = $data['quantity'];
            $pesanan->tgl_tempo = date('Y-m-d H:i:s', strtotime("+30 day",strtotime($data['tgl_selesai'])));
            $pesanan->kode = $data['kode'];
            $pesanan->id_customer = $data['id_customer'];
            $pesanan->tgl_pesan = $data['tgl_pesan'];
            $pesanan->tgl_selesai = $data['tgl_selesai'];
            $pesanan->status = 'order baru';
            $pesanan->save();

            DB::commit();
            $pesan ='pesanan Berhasil Ditambahkan';
            return redirect(route('pesanan'))->with('pesan',$pesan);

        } catch (\Throwable $th) {
           DB::rollback();
           throw $th;
        }
    }

    public function edit($id)
    {
        $datas = Pesanan::where('id',$id)->get();
        $customers = Customer::get();
        $products = Product::get();
        return view('pesanan.edit',compact('datas','customers','products'));
    }


    public function update(Request $request)
    {
        $dt_produk = Product::where('id', $request->id_product)->first();
        $harga_total = $request->quantity * $dt_produk->harga_jual;
        Pesanan::where('id',$request->id)->update([
            'kode'  => $request->kode,
            'id_customer'  => $request->id_customer,
            'id_product'  => $request->id_product,
            'quantity'  => $request->quantity,
            'harga_total'  => $harga_total,
            'tgl_pesan'  => $request->tgl_pesan,
            'tgl_selesai'  => $request->tgl_selesai,
            'status'  => $request->status,
        ]);

        $pesan ='pesanan Berhasil Diupdate...!!!';
        return redirect(route('pesanan'))->with('pesan',$pesan);
    }

    public function destroy($id)
    {
        $data = Pesanan::where('id',$id)->get();
        $data->delete();
        $pesan = 'pesanan Berhasil Dihapus...!!!';
        return redirect(route('pesanan'))->with('error',$pesan);
    }

    public function status($id){
        $datas = Pesanan::where('id',$id)->get();
        return view('pesanan.status',compact('datas'));
    }

    public function simpan_status_pesanan(Request $request)
    {
        DB::beginTransaction();
        try {
            Pesanan::where('id',$request->id)->update([
                'status' => $request->status,
            ]);
            DB::commit();
            $pesan ='Status Pesanan Berhasil Diupdate...!!!';
            return redirect(route('pesanan'))->with('pesan',$pesan);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function payment($id)
    {
        $datas = Pesanan::where('id',$id)->get();
        foreach($datas as $data){
            if(strtotime($data['tgl_tempo']) <= strtotime('10 day',strtotime(Carbon::now()))){
                $discount = $data->harga_total*2/100;
                $total = $data->harga_total - $discount;
                return view('pesanan.payment',compact('datas','discount','total'));
            }else{
                return view('pesanan.payment',compact('datas'));
            }
        }
    }

    public function payment_store(Request $request)
    {
        DB::beginTransaction();
        try {
            $datas = Pesanan::where('id',$request->id)->get();
            $image = $request->bukti_bayar;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('bukti_bayar'), $imageName);
            Payment::insert([
                'id_pesanan'   => $request->id_pesanan,
                'tgl_bayar' => $request->tgl_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'nama_rekening' => $request->nama_rekening,
                'no_rekening' => $request->no_rekening,
                'bukti_bayar' => $imageName,
            ]);
            Pesanan::where('id',$request->id_pesanan)->update([
                'status' => 'proses'
            ]);
            DB::commit();
            $pesan = 'Pembayaran Anda Berhasil';
            return redirect(route('pesanan'))->with('pesan',$pesan);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
