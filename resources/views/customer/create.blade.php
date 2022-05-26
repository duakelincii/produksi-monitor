@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pembuatan Data Customer Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('customer.simpan')}}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">Nama Customer</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Customer" required   >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">No Handphone</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="phone" placeholder="Masukan No Handphone" required >
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="">Alamat Email</label>
                        <div class="input-group mb-2">
                            <input type="email" name="email" class="form-control" placeholder="Masukan Email Customer" required >
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Alamat</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control " name="alamat" placeholder="Alamat Lengkap" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{route('customer')}}" class="btn btn-danger btn-block btn">
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
