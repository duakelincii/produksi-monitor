@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan Pesanan</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('pesanan')}}" method="GET">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Dari Tanggal :</label>
                        <div class="input-group mb-2">
                            <input type="date" class="form-control " name="start_date" id="start_date" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Sampai Tanggal :</label>
                        <div class="input-group mb-2">
                            <input type="date" class="form-control " name="end_date" id="end_date" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <a href="{{route('pesanan')}}"class="btn btn-danger btn-block btn "><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="" onclick=" this.href='/laporan-pesanan/excel/'+ document.getElementById('start_date').value +
                        '/'+ document.getElementById('end_date').value "
                        target="-blank" class="btn btn-success btn-block btn "><i class="far fa-file-excel"></i> Cetak Excel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
