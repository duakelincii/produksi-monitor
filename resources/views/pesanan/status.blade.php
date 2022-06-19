@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('simpan.status_pesanan')}}" method="post">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id" value="{{$data->id}}" >
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Nama Customer</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" value="{{$data->customer->nama}}" readonly>
                        </div>
                    </div>
                @endforeach
                    <div class="col-sm-12">
                        <label for="">Status Pesanan</label>
                        <div class="input-group mb-2">
                            <select name="status" id="" class="form-control">
                                <option value="proses">Proses</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{route('pesanan')}}" class="btn btn-danger btn-block btn">
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
