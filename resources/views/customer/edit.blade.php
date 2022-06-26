@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Customer</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('customer.update')}}" method="post">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id" value="{{$data->id}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">Nama Supplier</label>
                        <input type="text" name="nama" value="{{$data->nama}}" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">No Handphone</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="phone" value="{{$data->phone}}"  >
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="">Alamat Email</label>
                        <div class="input-group mb-2">
                            <input type="email" name="email" class="form-control" value="{{$data->email}}"  >
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Alamat</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control " name="alamat" value="{{$data->alamat}}" >
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
