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
use Alert;
use App\Aksesoris;
use App\Purchasingtambahan;
use PDF;

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
        $aksesoris = Aksesoris::get();
        return view('purchasing.create',compact('kode','suppliers','products','aksesoris'));
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
            $data = $request->all();
            $purche = new Purchasing();
            $purche->kode = $data['kode'];
            $purche->id_product = $data['id_product'];
            $purche->id_supplier = $data['id_supplier'];
            $purche->quantity = $data['quantity'];
            $purche->harga_barang = $data['quantity'] * $dt_produk->harga_beli;
            $purche->tgl_order = $data['tgl_order'];
            $purche->tgl_tempo = $data['tgl_tempo'];
            $purche->status = 'po baru';
            $purche->save();

            if(count($request->id_aksesoris) > 0){

                foreach ($request->id_aksesoris as $item=>$v)
                {
                    $dt_aksesoris = Aksesoris::where('id', $request->id_aksesoris[$item])->first();
                    $kurangi_stok = $dt_aksesoris->stock - $request->id_aksesoris[$item];
                    $detail[] = array(
                        'id_purchasing'  => $purche->id,
                        'id_product'    => $request->id_product,
                        'id_aksesoris' => $request->id_aksesoris[$item],
                        'qty_aksesoris' => $request->qty_aksesoris[$item],
                    );
                }
                Purchasingtambahan::insert($detail);
                Aksesoris::where('id',$request->id_aksesoris[$item])->update(['stock' => $kurangi_stok]);
            }

            DB::commit();
            Alert::success('Success','PO Berhasil Dibuat');
        return redirect(route('purchasing'));
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
       $aksesoris= Aksesoris::get();
       $tambahan = Purchasingtambahan::where('id_purchasing',$id)->get();
        return view('purchasing.stockin',compact('datas','products','aksesoris','tambahan'));
    }

    public function stockin_store(Request $request)
    {
           DB::beginTransaction();
           try {

            StockIn::insert([
                'id_purchasing' => $request->id_purchasing,
                'id_product'    => $request->id_product,
                'quantity'      => $request->quantity,
                'harga_beli'    => $request->harga_beli,
            ]);

            Purchasing::where('id',$request->id)->update([
                'status' => 'belum lunas',
            ]);

            $dt_produk = Product::where('id', $request->id_product)->first();
            $tambah_stock = $dt_produk->stock + $request->quantity;
            $margin = $request->harga_beli * $request->margin_harga/100;
            $harga_jual = $margin + $request->harga_beli;

            Product::where('id',$request->id_product)->update([
                    'stock'         => $tambah_stock,
                    'harga_beli'    => $request->harga_beli,
                    'harga_jual'    => $harga_jual,
            ]);

                if(count($request->id_acc) > 0){

                    foreach ($request->id_acc as $item=>$v)
                    {
                        $dt_aksesoris = Aksesoris::where('id', $request->id_acc[$item])->first();
                        $tambah_qty = $dt_aksesoris->stock + $request->qty_aksesoris[$item];
                    }
                    Aksesoris::where('id',$request->id_acc[$item])->update(['stock' => $tambah_qty]);
                }


            DB::commit();
            Alert::success('Success','Memasukan Stock Berhasil..!!!');
            return redirect(route('purchasing'));
           } catch (\Throwable $th) {
            DB::rollBack();
            Alert::warning('Gagal',$th);
            return $th ;
           }

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
            $imageName = $request->kode . '.' . $image->extension();
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
            Alert::success('Success','Pembayaran Anda Berhasil');
            return redirect(route('purchasing'));
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
        Alert::warning('Delete',$pesan);
        return redirect(route('purchasing'));
    }
}
