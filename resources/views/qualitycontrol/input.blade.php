@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('quality.simpan')}}" method="post">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id" value="{{$data->id}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Pilih Pesanan</label>
                        <div class="input-group mb-2">
                            <select name="id_pesanan" id="" class="form-control" readonly>
                                <option value="">Pilih pesanan</option>
                                @foreach ($pesanans as $pesanan)
                                    <option value="{{$pesanan->id}}" {{ $pesanan->id == $data->id_pesanan ? 'selected' : '' }}>
                                    {{$pesanan->customer->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Product</label>
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
                    <div class="col-sm-6">
                        <label for="">Jumlah Pesanan</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" value="{{$data->pesanan->quantity}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Barang Ready</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" name="barang_ready" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Barang Rusak</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="barang_rusak" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Keterangan</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="keterangan">
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{route('quality')}}" class="btn btn-danger btn-block btn">
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
