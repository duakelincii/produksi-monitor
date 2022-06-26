@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('stockin.simpan')}}" method="post" enctype="multipart/form-data">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id_purchasing" value="{{$data->id}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">No Pesanan</label>
                        <input type="text" value="{{$data->kode}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Pilih product</label>
                        <div class="input-group mb-2">
                            <select name="id_product" id="" class="form-control" readonly>
                                <option value="">Pilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}" {{ $product->id == $data->id_product ? 'selected' : '' }}>
                                    {{$product->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Jumlah PO</label>
                        <div class="input-group mb-2">
                            <input type="text" value="{{$data->quantity}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Jumlah Barang Datang</label>
                        <div class="input-group mb-2">
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Harga Beli</label>
                        <div class="input-group mb-2">
                            <input type="number" name="harga_beli" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Margin Harga</label>
                        <div class="input-group mb-2">
                            <input type="number" name="margin_harga" class="form-control">
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{route('purchasing')}}" class="btn btn-danger btn-block btn">
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
