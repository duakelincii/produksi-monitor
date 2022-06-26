<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Alert;

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
            'nama'  => strtoupper($request->nama),
            'stock'  => $request->stock,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
        ]);
        Alert::success('Success','Product Berhasil Diinput');
        return redirect(route('product'));
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
            'nama'  => strtoupper($request->nama),
            'stock'  => $request->stock,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
        ]);
        Alert::success('Success','Product Berhasil Diupdate');
        return redirect(route('product'));
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
        Alert::warning('Success','Product Berhasil Dihapus');
        return redirect(route('product'));
    }
}
