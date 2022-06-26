<?php

namespace App\Http\Controllers;

use App\Aksesoris;
use Illuminate\Http\Request;
use Alert;

class AksesorisController extends Controller
{
    public function index()
    {
        $datas = Aksesoris::get();
        return view('aksesoris.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aksesoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Aksesoris::insert([
            'nama_aksesoris'  => strtoupper($request->nama_aksesoris),
            'stock'  => $request->stock,
            'harga'  => $request->harga,
        ]);

        Alert::success('Success','aksesoris Berhasil ditambahkan');
        return redirect(route('aksesoris'));
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
        $datas = aksesoris::where('id',$id)->get();
        return view('aksesoris.edit',compact('datas'));
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
        Aksesoris::where('id',$request->id)->update([
            'nama_aksesoris'  => strtoupper($request->nama_aksesoris),
            'stock'  => $request->stock,
            'harga'  => $request->harga,
        ]);

        Alert::success('Success','aksesoris Berhasil diupdate');
        return redirect(route('aksesoris'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Aksesoris::findOrFail($id);
        $data->delete();
        Alert::warning('Delete','aksesoris Berhasil dihapus');
        return redirect(route('aksesoris'));
    }
}
