@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('purchasing.update')}}" method="post">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id" value="{{$data->id}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">No Pesanan</label>
                        <input type="text" name="no_po" value="{{$data->no_po}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Pilih Supplier</label>
                        <div class="input-group mb-2">
                            <select name="id_supplier" id="" class="form-control">
                                <option value="">Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}" {{ $supplier->id == $data->id_supplier ? 'selected' : '' }}>
                                    {{$supplier->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Tanggal Order</label>
                        <div class="input-group mb-2">
                            <input type="datetime-local" class="form-control" value="{{$data->tgl_order}}" name="tgl_order" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tanggal Jatuh Tempo</label>
                        <div class="input-group mb-2">
                            <input type="datetime-local" class="form-control " name="tgl_tempo" value="{{$data->tgl_tempo}}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Status Order</label>
                        <div class="input-group mb-2">
                            <select name="status" class="form-control" id="">
                                <option value="">Status Pesanan</option>
                                <option value="belum lunas">Belum Lunas</option>
                                <option value="jatuh tempo">Jatuh Tempo</option>
                                <option value="lunas">Lunas</option>
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
