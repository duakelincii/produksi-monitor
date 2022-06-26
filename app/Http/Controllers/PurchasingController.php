<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentPurchasing;
use App\Product;
use App\Purchasing;
use App\StockIn;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class PurchasingController extends Controller
{
    public function index()
    {
        $datas = Purchasing::get();
        return view('purchasing.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = 'PO-'.rand();
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('purchasing.create',compact('kode','suppliers','products'));
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
            $dt_produk = Product::where('id', $request->id_product)->first();
            $harga_total = $request->quantity ;
            Purchasing::insert([
                'kode'  => $request->kode,
                'id_supplier'  => $request->id_supplier,
                'id_product'  => $request->id_product,
                'quantity'  => $request->quantity,
                'harga_barang'  => $request->quantity * $dt_produk->harga_beli,
                'tgl_order'  => $request->tgl_order,
                'tgl_tempo'  => $request->tgl_tempo,
                'status'  => 'belum lunas',
            ]);
            DB::commit();
        $pesan ='purchasing Berhasil Ditambahkan';
        return redirect(route('purchasing'))->with('pesan',$pesan);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function store_status(Request $request)
    {
        Purchasing::where('id',$request->id)->update([
            'status' => $request->status
        ]);
        $pesan = 'Status Berhasil Diupdate';
        return redirect(route('purchasing'))->with('pesan',$pesan);
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


    public function stockin($id)
    {
       $datas = Purchasing::where('id',$id)->get();
       $products = Product::get();
        return view('purchasing.stockin',compact('datas','products'));
    }

    public function stockin_store(Request $request)
    {
            StockIn::insert([
                'id_purchasing' => $request->id_purchasing,
                'id_product'    => $request->id_product,
                'quantity'      => $request->quantity,
                'harga_beli'    => $request->harga_beli,
            ]);
            $dt_produk = Product::where('id', $request->id_product)->first();
            $tambah_stock = $dt_produk->stock + $request->quantity;
            $margin = $request->harga_beli * $request->margin_harga/100;
            $harga_jual = $margin + $request->harga_beli;
            Purchasing::where('id',$request->id)->update([
                'status' => 'selesai',
            ]);
            Product::where('id',$request->id_product)->update([
                'stock' => $tambah_stock,
                'harga_beli'    => $request->harga_beli,
                'harga_jual'    => $harga_jual,
            ]);

            $pesan = 'Memasukan Stock Berhasil..!!!';
            return redirect(route('purchasing'))->with('pesan',$pesan);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Purchasing::where('id',$id)->get();
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('purchasing.edit',compact('datas','suppliers','products'));
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
        DB::beginTransaction();
        try {
            $dt_produk = Product::where('id', $request->id_product)->first();
        $harga_total = $request->quantity * $dt_produk->harga_jual;
        Purchasing::where('id',$request->id)->update([
            'kode'  => $request->kode,
            'id_supplier'  => $request->id_supplier,
            'id_product'  => $request->id_product,
            'quantity'  => $request->quantity,
            'harga_total'  => $harga_total,
            'tgl_order'  => $request->tgl_order,
            'tgl_tempo'  => $request->tgl_tempo,
            'status'  => $request->status,
            'updated_at'    => Carbon::now(),
        ]);
        DB::commit();
        $pesan ='purchasing Berhasil Diupdate...!!!';
        return redirect(route('purchasing'))->with('pesan',$pesan);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function payment($id)
    {
        $datas = Purchasing::where('id',$id)->get();
        $suppliers = Supplier::get();
        foreach($datas as $data){
            if(strtotime($data['tgl_tempo']) <= strtotime('10 day',strtotime(Carbon::now()))){
                $discount = $data->harga_barang*2/100;
                $total = $data->harga_barang - $discount;
                return view('purchasing.payment',compact('datas','discount','total','suppliers'));
            }else{
                return view('purchasing.payment',compact('datas','suppliers'));
            }
        }
    }

    public function payment_store(Request $request)
    {
        DB::beginTransaction();
        try {
            $datas = Purchasing::where('id',$request->id)->get();
            $image = $request->bukti_bayar;
            $imageName = "PO" . time() . '.' . $image->extension();
            $image->move(public_path('bukti_bayar'), $imageName);
            Payment::insert([
                'id_purchasing'   => $request->id_purchasing,
                'tgl_bayar' => $request->tgl_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'nama_rekening' => $request->nama_rekening,
                'no_rekening' => $request->no_rekening,
                'bukti_bayar' => $imageName,
            ]);
            Purchasing::where('id',$request->id_purchasing)->update([
                'status' => 'lunas'
            ]);
            DB::commit();
            $pesan = 'Pembayaran Anda Berhasil';
            return redirect(route('purchasing'))->with('pesan',$pesan);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy($id)
    {
        $data = Purchasing::findOrFail($id);
        $data->delete();
        $pesan = 'purchasing Berhasil Dihapus...!!!';
        return redirect(route('purchasing'))->with('error',$pesan);
    }
}
