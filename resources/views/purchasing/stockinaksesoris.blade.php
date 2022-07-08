@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Stock In Aksesoris</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('stockin.aksesoris')}}" method="post" enctype="multipart/form-data">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id_purchasing" value="{{$data->id}}">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">No Pesanan</label>
                        <input type="text" value="{{$data->kode}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">Nama Supplier</label>
                        <input type="text" value="{{$data->supplier->nama}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="nama_customer">Tanggal Pesan</label>
                        <input type="text" value="{{\Carbon\Carbon::parse($data->tgl_order)->isoFormat('D MMMM Y')}}" class="form-control" disabled readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="nama_customer">Tanggal Jatuh Tempo</label>
                        <input type="text" value="{{\Carbon\Carbon::parse($data->tgl_tempo)->isoFormat('D MMMM Y')}}" class="form-control" disabled readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="nama_customer">Total Harga</label>
                        <input type="text" value="@rupiah($data->harga_barang)" class="form-control" disabled readonly>
                    </div>
                </div>
                @endforeach

                <div class="card">
                    <div class="card-header">
                        Aksesoris
                    </div>

                    <div class="card-body">
                        <table class="table" id="products_table">
                            <thead>
                                <tr>
                                    <th>Aksesoris</th>
                                    <th>Quantity</th>
                                    <th>Barang Datang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tambahan_aksesoris as $value )
                                <tr id="product0">
                                    <td>
                                        <input type="hidden" name="id_aksesoris[]" value="{{$value->id_aksesoris}}">
                                        <input type="text" value="{{$value->aksesoris->nama_aksesoris}}" class="form-control" readonly disabled>
                                    </td>
                                    <td>
                                        <input type="number" value="{{$value->qty_aksesoris}}" class="form-control" readonly disabled />
                                    </td>
                                    <td>
                                        <input type="number" name="qty_aksesoris[]" class="form-control" />
                                    </td>
                                </tr>
                                <tr id="product1"></tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

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
