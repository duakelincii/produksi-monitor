<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Product::get();
        return view('product.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::insert([
            'nama'  => $request->nama,
            'stock'  => $request->stock,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
            'status'  => $request->status,
        ]);

        $pesan ='Product Berhasil Ditambahkan';
        return redirect(route('product'))->with('pesan',$pesan);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Product::where('id',$id)->get();
        return view('product.edit',compact('datas'));
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
        Product::where('id',$request->id)->update([
            'nama'  => $request->nama,
            'stock'  => $request->stock,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
            'status'  => $request->status,
        ]);
        $pesan = 'Product Berhasil Di Update...!!!';
        return redirect(route('product'))->with('pesan',$pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
        $pesan = 'Product Berhasil Dihapus...!!!';

        return redirect(route('product'))->with('error',$pesan);
    }
}
