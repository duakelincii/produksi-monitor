@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman</h6>
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
                            <th>Surat Jalan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Jalan</th>
                            <th>Supir</th>
                            <th>No Kendaraan</th>
                            <th>Surat Jalan</th>
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
                                    <a href="{{route('pengiriman.cetak',$data->id)}}" target="-blank" title="PDF" class="btn btn-sm btn-info"><i class="fas fa-file-pdf"></i> PDF</a>
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
            $('#pengiriman').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
