@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('product.simpan')}}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">Nama Product</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Product">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Stock Product</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control " name="stock" placeholder="Stock Barang">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Harga Beli</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="harga_beli" placeholder="Harga Beli">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Harga Jual</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="harga_jual" placeholder="Harga Jual">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{route('product')}}" class="btn btn-danger btn-block btn">
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
