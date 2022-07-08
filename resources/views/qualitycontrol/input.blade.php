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
                <input type="hidden" name="id_product" value="{{$data->id_product}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Pilih Pesanan</label>
                        <div class="input-group mb-2">
                            <input type="text" value="{{$data->customer->nama}}" class="form-control" disabled readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Product</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" value="{{$data->product->nama_product}}" disabled readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Jumlah Pesanan</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" value="{{$data->quantity}}" readonly>
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
