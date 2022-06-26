<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Alert;

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
            'nama'  => strtoupper($request->nama),
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        Alert::success('Success','Supplier Berhasil ditambahkan');
        return redirect(route('supplier'));
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
            'nama'  => strtoupper($request->nama),
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        Alert::success('Success','Supplier Berhasil diupdate');
        return redirect(route('supplier'));
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
        Alert::warning('Success','Supplier Berhasil dihapus');
        return redirect(route('supplier'));
    }
}
