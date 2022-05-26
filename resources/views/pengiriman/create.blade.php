@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="customer" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Jalan</th>
                            <th>Harga Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Jalan</th>
                            <th>Harga Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($items as $data)
                            <tr>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->customer->nama }}</td>
                                <td>{{ $data->tgl_pesan }}</td>
                                <td>@rupiah($data->harga_total)</td>
                                <td>
                                    @if ($data->status == 'siap kirim')
                                        <div class="badge badge-primary"> SIAP KIRIM </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pengiriman.create_id', $data->id) }}"
                                        class="btn btn-primary btn-block">Pilih</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
