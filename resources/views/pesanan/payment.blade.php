@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Product Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{route('payment.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @foreach ($datas as $data )
                <input type="hidden" name="id_pesanan" value="{{$data->id}}" id="">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="nama_customer">No Pesanan</label>
                        <input type="text" value="{{$data->kode}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Pilih Customer</label>
                        <div class="input-group mb-2">
                            <select name="id_customer" id="" class="form-control" readonly>
                                    <option value="{{$data->id_customer}}" {{ $data->id == $data->id_customer ? 'selected' : '' }}>
                                    {{$data->customer->nama}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Tanggal Jatuh Tempo</label>
                        <div class="input-group mb-2">
                            <input type="text" value="{{\Carbon\Carbon::parse($data->tgl_tempo)->isoFormat('D MMMM Y')}}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Harga Total</label>
                        <div class="input-group mb-2">
                            <input type="text" value="@rupiah($data->harga_total)" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                @if (strtotime($data->tgl_tempo) <= strtotime('10 day',strtotime(\Carbon\Carbon::now())))
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Jumlah Discount</label>
                        <div class="input-group mb-2">
                            <input type="text" value="@rupiah($discount)" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Persentase Discount</label>
                        <div class="input-group mb-2">
                            <input type="text" value="2%" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Jumlah Dibayarkan</label>
                        <div class="input-group mb-2">
                            <input type="text" value="@rupiah($total)" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                @else
                @endif
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Nama Rekening</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="nama_rekening" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Nomor Rekening</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="no_rekening" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Tanggal Bayar</label>
                        <div class="input-group mb-2">
                            <input type="datetime-local" class="form-control" name="tgl_bayar" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Jumlah Bayar</label>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control " name="jumlah_bayar" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Bukti Pembayaran</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" name="bukti_bayar" required>
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
