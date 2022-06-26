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
                            <th>Tanggal Pesen</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Tahapan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Pesen</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Tahapan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->customer->nama}}</td>
                            <td>{{\Carbon\Carbon::parse($data->tgl_order)->isoFormat('D MMMM Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($data->tgl_selesai)->isoFormat('D MMMM Y')}}</td>
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
                                    @elseif ($data->status == 'selesai')
                                        <div class="badge badge-success"> SELESAI </div>
                                    @endif
                            </td>
                            <td>
                                @if ($data->status == 'order baru')
                                <a href="{{route('pesanan.proses',$data->id)}}" class="btn btn-warning btn-sm" title="Proses"><i class="fas fa-tasks"></i> Proses</a>
                                @elseif ($data->status == 'terkirim')
                                <a href="{{route('pesanan.payment',$data->id)}}" class="btn btn-sm btn-success" title="Bayar"><i class="fas fa-money-bill"></i> Payment</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('pesanan.detail',$data->id)}}" class="btn btn-sm btn-secondary" title="Detail"><i class="fas fa-file-alt"></i></a>
                                @if ($data->status == 'siap kirim')
                                <a href="{{route('pesanan.invoice',$data->id)}}" target="-blank" class="btn btn-sm btn-info" title="PDF"><i class="fas fa-file-pdf"></i></a>
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
            $('#pesanan').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
