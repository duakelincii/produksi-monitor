@extends('layouts.master')
@section('content')
<div class="card shadow mb-4">
    <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="tambahrm">
      <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6> </a>
    </a>
    <div class="collapse show" id="tambahrm">
    <div class="card-body">
    <div class="row">
        {{-- <div class="col-sm-12" align="right">
        <a href="" class="btn btn-warning btn-icon-split">
            <span class="icon">
            <i style="padding-top:4px"class="fas fa-pen"></i>
            </span>
            <span class="text">Edit</span>
            </a>
            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal" class="btn btn-icon-split btn-danger">
            <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus Rekam Medis</span></a>
        </div> --}}
    </div>
        <form class="user" action="" method="post">
            @foreach ($datas as $data )
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>No Pesanan</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->kode }}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Nama Pesanan</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->customer->nama }}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Tanggal Pesan</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->tgl_pesan }}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Tanggal Selesai</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->tgl_selesai }}</p>
                </div>
            </div>
                @endforeach

                    <div class="form-group row">
                        <div class="col-sm-3 text-md-right">
                            <label for="keluhan-utama"><strong>Product</strong></label>
                        </div>
                        <div class="col-sm-1 text-md-center">
                            :
                        </div>
                        <div class="col-sm-8">
                            <p class="text-md-left">{{ $data->product->nama }} / {{$data->barang_ready}} Pcs</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 text-md-right">
                            <label for="keluhan-utama"><strong>Total Harga</strong></label>
                        </div>
                        <div class="col-sm-1 text-md-center">
                            :
                        </div>
                        <div class="col-sm-8">
                            <p class="text-md-left">@rupiah($data->harga_total)</p>
                        </div>
                    </div>


            </div>



            <div class="form-group row">
            <div class="col-sm-4 ml-3 mb-sm-0" align="right">
                <a href= "{{route('pesanan')}}" class="btn btn-danger btn-block" name="simpan">
                     <i class="fas fa-arrow-left fa-fw"></i> kembali
                </a>
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0">

            </div>
        </form>
    </div>
    </div>

</div>
@endsection
