<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Supplier::get();
        return view('supplier.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Supplier::insert([
            'nama'  => $request->nama,
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        $pesan ='Supplier Berhasil Ditambahkan';
        return redirect(route('supplier'))->with('pesan',$pesan);
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
        $datas = Supplier::where('id',$id)->get();
        return view('supplier.edit',compact('datas'));
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
        Supplier::where('id',$request->id)->update([
            'nama'  => $request->nama,
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        $pesan ='Supplier Berhasil Diupdate...!!!';
        return redirect(route('supplier'))->with('pesan',$pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();
        $pesan = 'Supplier Berhasil Dihapus...!!!';
        return redirect(route('supplier'))->with('error',$pesan);
    }
}
