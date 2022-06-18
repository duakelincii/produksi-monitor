@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Quality Control</h6>
            <div>
                <a href="{{route('quality.create')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah QC</a>
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
                            <td>{{$data->pesanan->customer->nama}}</td>
                            <td>{{$data->pesanan->tgl_selesai}}</td>
                            <td>
                                @if ($data->status == 'cuting')
                                <div class="badge badge-warning"> Cutting </div>
                                 @elseif ($data->status == 'jahit')
                                <div class="badge badge-warning"> Jahit </div>
                                 @elseif ($data->status == 'finishing')
                                <div class="badge badge-primary"> Finishing </div>
                                 @elseif ($data->status == 'selesai')
                                <div class="badge badge-success"> Selesai </div>
                                @endif
                            </td>
                            <td>
                                @if ($data->status == 'cuting')
                                <a href="{{route('quality.status',$data->id)}}" class="btn btn-primary">Proses</a>
                                @elseif ($data->status == 'jahit')
                                <a href="{{route('quality.status',$data->id)}}" class="btn btn-primary">Proses</a>
                                @elseif ($data->status == 'finishing')
                                <a href="{{route('quality.input',$data->id)}}" class="btn btn-success">Sortir</a>
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
