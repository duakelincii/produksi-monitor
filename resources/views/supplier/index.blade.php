@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
            <div>
                <a href="{{route('supplier.create')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah Supplier</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="supplier" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>No Handphone</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>No Handphone</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>
                                <a href="{{route('supplier.edit',$data->id)}}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{route('supplier.delete',$data->id)}}" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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
            $('#supplier').DataTable();
        });
    </script>
@endsection
