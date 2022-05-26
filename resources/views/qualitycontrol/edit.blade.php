@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('pesanan.update')}}" method="post">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id" value="{{$data->id}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">No Pesanan</label>
                        <input type="text" name="kode" value="{{$data->kode}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Pilih Customer</label>
                        <div class="input-group mb-2">
                            <select name="id_customer" id="" class="form-control">
                                <option value="">Pilih Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}" {{ $customer->id == $data->id_customer ? 'selected' : '' }}>
                                    {{$customer->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Product</label>
                        <div class="input-group mb-2">
                            <select name="id_product" id="" class="form-control">
                                <option value="">Pilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}" {{ $product->id == $data->id_product ? 'selected' : '' }}>
                                    {{$product->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Jumlah Pesanan</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" value="{{$data->quantity}}" name="quantity" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Tanggal Order</label>
                        <div class="input-group mb-2">
                            <input type="datetime-local" class="form-control" value="{{$data->tgl_pesan}}" name="tgl_pesan" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tanggal Selesai</label>
                        <div class="input-group mb-2">
                            <input type="datetime-local" class="form-control " name="tgl_selesai" value="{{$data->tgl_selesai}}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Status Order</label>
                        <div class="input-group mb-2">
                            <select name="status" class="form-control" id="">
                                <option value="">Status Pesanan</option>
                                <option value="order baru">Order Baru</option>
                                <option value="proses">Proses</option>
                                <option value="siap kirim">Siap Kirim</option>
                                <option value="terkirim">Terkirim</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="" class="btn btn-danger btn-block btn">
                            <i class="fas fa-arrow-left fa-fw"></i> Kembali
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save fa-fw"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
