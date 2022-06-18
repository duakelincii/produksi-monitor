@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Purchasing</h6>
            <div>
                <a href="{{route('purchasing.create')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah Purchasing</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pesanan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->supplier->nama}}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_tempo)->format('d-m-Y')}}</td>
                            <td>
                                @if ($data->status == 'belum lunas')
                                        <div class="badge badge-danger"> Belum Lunas </div>
                                    @elseif ($data->status == 'jatuh tempo')
                                        <div class="badge badge-warning"> Jatuh Tempo </div>
                                    @elseif ($data->status == 'lunas')
                                        <div class="badge badge-success"> Lunas </div>
                                    @elseif ($data->status == 'selesai')
                                        <div class="badge badge-success"> Selesai </div>
                                    @endif
                            </td>
                            <td>
                                @if ($data->status =='belum lunas' && 'jatuh tempo')
                                <a href="{{route('purchasing.edit',$data->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('purchasing.payment',$data->id)}}" class="btn btn-warning btn-sm">Payment</a>
                                @elseif ($data->status == 'lunas')
                                <a href="{{route('purchasing.stockin',$data->id)}}" class="btn btn-success btn-sm">stock In</a>
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
