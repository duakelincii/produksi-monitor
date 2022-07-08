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
                            <th>Label</th>
                            <th>Action</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Label</th>
                            <th>Action</th>
                            <th>Payment</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->supplier->nama}}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_tempo)->format('d-m-Y')}}</td>
                            <td>
                                    @if ($data->status == 'stockin')
                                        <div class="badge badge-info"> Sudah StockIn </div>
                                    @elseif($data->status == 'po baru')
                                        <div class="badge badge-danger"> PO BARU </div>
                                    @elseif ($data->status == 'lunas')
                                        <div class="badge badge-success"> Lunas </div>
                                    @elseif ($data->status == 'selesai')
                                        <div class="badge badge-success"> Selesai </div>
                                    @elseif ($data->tgl_tempo > 1)
                                        <div class="badge badge-warning"> Jatuh Tempo </div>
                                    @endif
                            </td>
                            <td>
                                @if ($data->label == 'product')
                                        <div class="badge badge-secondary"> BAHAN </div>
                                    @elseif($data->label == 'aksesoris')
                                        <div class="badge badge-secondary"> AKSESORIS </div>
                                        @endif
                            </td>
                            <td>
                                @if ($data->status =='po baru')
                                    @if ($data->label == 'product')
                                    <a href="{{route('purchasing.stockin',$data->id)}}" class="btn btn-success btn-sm">STOCK IN</a>
                                    @elseif($data->label == 'aksesoris')
                                    <a href="{{route('purchasing.stockin_aksesoris',$data->id)}}" class="btn btn-success btn-sm">STOCK IN</a>
                                    @endif
                                @endif
                                </td>
                            <td>
                                @if ($data->status != 'lunas')
                                <a href="{{route('purchasing.payment',$data->id)}}" class="btn btn-sm btn-success" title="Bayar"><i class="fas fa-money-bill"></i> Payment</a>
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
