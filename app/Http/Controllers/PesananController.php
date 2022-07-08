<?php

namespace App\Http\Controllers;

use App\Aksesoris;
use App\Customer;
use App\Paket;
use App\Payment;
use App\Pesanan;
use App\Pesenandetails;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use App\Pesanantambahan;
use PDF;

class PesananController extends Controller
{

    public function index()
    {
        $datas = Pesanan::get();
        return view('pesanan.index',compact('datas'));
    }

    public function proses($id)
    {
        $data = Pesanan::where('id',$id);
        $data->update([
            'status' => 'proses'
        ]);
        Alert::success('Success','Pesanan Berhasil diproses');
        return redirect(route('pesanan'));
    }

    public function create()
    {
        $kode = 'OR-'.rand();
        $customers = Customer::get();
        $products = Product::get();
        $aksesoris = Aksesoris::get();
        return view('pesanan.create',compact('kode','customers','products','aksesoris'));
    }

    public function detail($id)
    {
        $datas = Pesanan::where('id',$id)->get();
        $values = Pesanantambahan::where('id_pesanan',$id)->get();
        $payment = Payment::where('id_pesanan',$id)->get();
        return view('pesanan.detail',compact('datas','payment','values'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $pesanan = new Pesanan;
            $pesanan->tgl_tempo = date('Y-m-d H:i:s', strtotime("+30 day",strtotime($data['tgl_selesai'])));
            $pesanan->kode = $data['kode'];
            $pesanan->id_product = $data['id_product'];
            $pesanan->quantity = $data['quantity'];
            $pesanan->id_customer = $data['id_customer'];
            $pesanan->tgl_pesan = $data['tgl_pesan'];
            $pesanan->tgl_selesai = $data['tgl_selesai'];
            $pesanan->status = 'order baru';
            $pesanan->save();

            if(count($request->id_aksesoris) > 0){
            foreach ($request->id_aksesoris as $item=>$v)
            {
                    $dt_aksesoris = Aksesoris::where('id', $request->id_aksesoris[$item])->first();
                    $dt_product = Product::where('id', $request->id_product)->first();
                    $kurangi_stok = $dt_aksesoris->stock - $request->qty_aksesoris[$item];
                    $sisa_stock = $dt_product->stock - $request->quantity;
                    $harga_total = ($dt_product->harga_jual * $request->quantity) + ($dt_aksesoris->harga * $request->qty_aksesoris[$item]);
                    $detail[] = array(
                        'id_pesanan'  => $pesanan->id,
                        'id_aksesoris' => $request->id_aksesoris[$item],
                        'qty_aksesoris' => $request->qty_aksesoris[$item],
                    );
                }
                Pesanantambahan::insert($detail);
                Product::where('id',$request->id_product)->update(['stock' => $sisa_stock]);
                Pesanan::where('id',$pesanan->id)->update(['harga_total' => $harga_total]);
                Aksesoris::where('id',$request->id_aksesoris[$item])->update(['stock' => $kurangi_stok]);
            }

            DB::commit();
            Alert::success('Success','Pesanan Berhasil Dibuat');
            return redirect(route('pesanan'));

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

        Alert::success('Success','Pesanan Berhasil Diupdate');
        return redirect(route('pesanan'));
    }

    public function destroy($id)
    {
        $data = Pesanan::where('id',$id)->get();
        $data->delete();
        Alert::warning('Success','Pesanan Berhasil Dibuat');
        return redirect(route('pesanan'));
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
            $imageName = $request->kode . '.' . $image->extension();
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
                'status' => 'selesai'
            ]);
            DB::commit();
            Alert::success('Success','Pembayaran Berhasil Dilakukan');
            return redirect(route('pesanan'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function invoice($id)
    {
        $datas = Pesanan::findOrFail($id);
        $value = Pesanantambahan::where('id_pesanan' , $id)->get();
        $pdf = PDF::loadView('pdf.invoice',compact('datas'))->setPaper('A4','potrait');
        return $pdf->stream();
    }
}
