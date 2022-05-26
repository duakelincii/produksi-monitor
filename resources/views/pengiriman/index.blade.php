@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman</h6>
            <div>
                <a href="{{ route('pengiriman.create') }}"
                    class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah Pengiriman</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pengiriman" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Jalan</th>
                            <th>Supir</th>
                            <th>No Kendaraan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Jalan</th>
                            <th>Supir</th>
                            <th>No Kendaraan</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->pesanan->kode }}</td>
                                <td>{{ $data->customer->nama }}</td>
                                <td>{{ $data->tgl_kirim }}</td>
                                <td>{{ $data->nama_supir }}</td>
                                <td>{{ $data->no_kendaraan }}</td>
                                <td>
                                    @if ($data->pesanan->status == 'terkirim')
                                        <div class="badge badge-success"> TERKIRIM </div>
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
            $('#pengiriman').DataTable();
        });
    </script>
@endsection
