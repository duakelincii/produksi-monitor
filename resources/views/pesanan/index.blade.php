@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data pesanan</h6>
            <div>
                <a href="{{route('pesanan.create')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah pesanan</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pesanan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->customer->nama}}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y')}}</td>
                            <td>
                                @if ($data->status == 'order baru')
                                        <div class="badge badge-danger"> ORDER BARU </div>
                                    @elseif ($data->status == 'proses')
                                        <div class="badge badge-warning"> PROSES </div>
                                    @elseif ($data->status == 'cuting')
                                        <div class="badge badge-warning"> CUTTING </div>
                                    @elseif ($data->status == 'jahit')
                                        <div class="badge badge-warning"> JAHIT </div>
                                    @elseif ($data->status == 'finishing')
                                        <div class="badge badge-warning"> FINISHING </div>
                                    @elseif ($data->status == 'siap kirim')
                                        <div class="badge badge-primary"> SIAP KIRIM </div>
                                    @elseif ($data->status == 'terkirim')
                                        <div class="badge badge-success"> TERKIRIM </div>
                                    @endif
                            </td>
                            <td>
                                @if ($data->status == 'order baru')
                                <a href="{{route('pesanan.edit',$data->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{route('pesanan.payment',$data->id)}}" class="btn btn-success">Bayar</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#pesanan').DataTable();
        });
    </script>
@endsection
