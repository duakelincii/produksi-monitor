<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

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
            'nama'  => $request->nama,
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        $pesan ='Customer Berhasil Ditambahkan';
        return redirect(route('customer'))->with('pesan',$pesan);
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
            'nama'  => $request->nama,
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'phone'  => $request->phone,
        ]);

        $pesan ='Customer Berhasil Diupdate...!!!';
        return redirect(route('customer'))->with('pesan',$pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::findOrFail($id);
        $data->delete();
        $pesan = 'Customer Berhasil Dihapus...!!!';
        return redirect(route('customer'))->with('error',$pesan);
    }
}
