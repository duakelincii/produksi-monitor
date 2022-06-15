@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Product</h6>
            <div>
                <a href="{{route('product.create')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah Product</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="product" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Stock</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Stock</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->stock}}</td>
                            <td>{{$data->harga_beli}}</td>
                            <td>{{$data->harga_jual}}</td>
                            <td>
                                @if ($data->status == 'ready')
                                <div class="badge badge-success"> Ready </div>
                            @elseif ($data->status == 'sold')
                                <div class="badge badge-danger"> Sold </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('product.edit',$data->id)}}" class="btn btn-primary">Edit</a>
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
            $('#product').DataTable();
        });
    </script>
@endsection
