<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Customer::get();
        return view('customer.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Customer::insert([
            'nama'  => strtoupper($request->nama),
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        Alert::success('Success','Customer Berhasil ditambahkan');
        return redirect(route('customer'));
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
        $datas = Customer::where('id',$id)->get();
        return view('customer.edit',compact('datas'));
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
        Customer::where('id',$request->id)->update([
            'nama'  => strtoupper($request->nama),
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);
        Alert::success('Success','Customer Berhasil diupdate');
        return redirect(route('customer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::where('id',$id);
        $data->delete();
        Alert::warning('Delete','Customer Berhasil dihapus');
        return redirect(route('customer'));
    }
}
