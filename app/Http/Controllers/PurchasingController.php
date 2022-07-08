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
use App\Purchasingproduct;
use App\Purchasingtambahan;
use PDF;

class PurchasingController extends Controller
{
    public function index()
    {
        $datas = Purchasing::get();
        return view('purchasing.index',compact('datas'));
    }

    public function create()
    {
        $kode = 'PO-'.rand();
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('purchasing.create',compact('kode','suppliers','products'));
    }

    public function createaksesoris()
    {
        $kode = 'PO-'.rand();
        $suppliers = Supplier::get();
        $aksesoris = Aksesoris::get();
        return view('purchasing.aksesoris',compact('kode','suppliers','aksesoris'));
    }

    public function store(Request $request)
    {
            // dd($request->all());
        DB::beginTransaction();
        try {
            $data = $request->all();
            $purche = new Purchasing();
            $purche->kode = $data['kode'];
            $purche->id_supplier = $data['id_supplier'];
            $purche->tgl_order = $data['tgl_order'];
            $purche->tgl_tempo = $data['tgl_tempo'];
            $purche->label = 'product';
            $purche->status = 'po baru';
            $purche->save();
            if(count($request->id_product) > 0){

            foreach ($request->id_product as $item=>$v)
                {
                    $dt_product = Product::where('id', $request->id_product[$item])->first();
                    $harga_total = ($dt_product->harga_beli * $request->qty_product[$item]);
                    $detail[] = array(
                        'id_purchasing'  => $purche->id,
                        'id_product'    => $request->id_product[$item],
                        'qty_product' => $request->qty_product[$item],
                    );
                }
                Purchasingproduct::insert($detail);
                Purchasing::where('id' , $purche->id)->update(['harga_barang' => $harga_total]);
            }
            DB::commit();
            Alert::success('Success','PO Product Berhasil Dibuat');
        return redirect(route('purchasing'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function storeaksesoris(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $purche = new Purchasing();
            $purche->kode = $data['kode'];
            $purche->id_supplier = $data['id_supplier'];
            $purche->tgl_order = $data['tgl_order'];
            $purche->tgl_tempo = $data['tgl_tempo'];
            $purche->label = 'aksesoris';
            $purche->status = 'po baru';
            $purche->save();
            if(count($request->id_aksesoris) > 0){

                foreach ($request->id_aksesoris as $item=>$v)
                {
                    $dt_aksesoris = Aksesoris::where('id', $request->id_aksesoris[$item])->first();
                    $harga_total = $dt_aksesoris->harga * $request->qty_aksesoris[$item];
                    $detail[] = array(
                        'id_purchasing'  => $purche->id,
                        'id_aksesoris' => $request->id_aksesoris[$item],
                        'qty_aksesoris' => $request->qty_aksesoris[$item],
                    );
                }
                Purchasingtambahan::insert($detail);
                Purchasing::where('id' , $purche->id)->update(['harga_barang' => $harga_total]);
            }
            DB::commit();
            Alert::success('Success','PO Aksesoris Berhasil Dibuat');
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

    public function stockin($id)
    {
       $datas = Purchasing::where('id',$id)->get();
       $tambahan_aksesoris = Purchasingtambahan::where('id_purchasing',$id)->get();
       $tambahan_product = Purchasingproduct::where('id_purchasing',$id)->get();
        return view('purchasing.stockin',compact('datas','tambahan_aksesoris','tambahan_product'));
    }
    public function stockin_acc($id)
    {
       $datas = Purchasing::where('id',$id)->get();
       $tambahan_aksesoris = Purchasingtambahan::where('id_purchasing',$id)->get();
       $tambahan_product = Purchasingproduct::where('id_purchasing',$id)->get();
        return view('purchasing.stockinaksesoris',compact('datas','tambahan_aksesoris','tambahan_product'));
    }

    public function stockin_store(Request $request)
    {
        // dd($request->all());
           DB::beginTransaction();
           try {
                Purchasing::where('id',$request->id_purchasing)->update(['status' => 'stockin']);
            if(count($request->id_product) > 0){

                foreach ($request->id_product as $item=>$v)
                    {
                        $dt_product = Product::where('id', $request->id_product[$item])->first();
                         $margin = $request->harga_beli[$item] * $request->margin[$item]/100;
                         $harga_jual = $margin + $request->harga_beli[$item];
                         $tambah_qty = $dt_product->stock + $request->qty_product[$item];
                         $detail[] = array(
                             'id_purchasing' => $request->id_purchasing,
                             'id_product' => $request->id_product[$item],
                             'qty_product' => $request->qty_product[$item],
                             );
                    }
                         StockIn::insert($detail);
                         Product::where('id',$request->id_product[$item])->update([
                             'stock'         => $tambah_qty,
                             'harga_beli'    => $request->harga_beli[$item],
                             'harga_jual'    => $harga_jual,
                         ]);
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
    public function stockin_aksesoris(Request $request)
    {
        // dd($request->all());
           DB::beginTransaction();
           try {
               Purchasing::where('id',$request->id_purchasing)->update(['status' => 'stockin']);
            if(count($request->id_aksesoris) > 0){

                foreach ($request->id_aksesoris as $item=>$v)
                    {
                        $dt_aksesoris = Aksesoris::where('id', $request->id_aksesoris[$item])->first();
                        $tambah_qty = $dt_aksesoris->stock + $request->qty_aksesoris[$item];
                        $detail[] = array(
                                'id_purchasing' => $request->id_purchasing,
                                'id_aksesoris' => $request->id_aksesoris[$item],
                                'qty_aksesoris' => $request->qty_aksesoris[$item]
                        );
                    }
                    StockIn::insert($detail);
                    Aksesoris::where('id',$request->id_aksesoris[$item])->update(['stock' => $tambah_qty]);
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

    public function edit($id)
    {
        $datas = Purchasing::where('id',$id)->get();
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('purchasing.edit',compact('datas','suppliers','products'));
    }

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
