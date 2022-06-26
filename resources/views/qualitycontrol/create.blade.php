@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data pesanan</h6>
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
                                @if ($data->status == 'proses')
                                        <div class="badge badge-warning"> Proses </div>
                                    @endif
                            </td>
                            <td>
                                <a href="{{route('quality.proses',$data->id)}}" class="btn btn-sm btn-warning">Proses</a>
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
