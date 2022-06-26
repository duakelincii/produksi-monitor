@extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">Data Aksesoris</h6>
            <div>
                <a href="{{route('aksesoris.create')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah Aksesoris</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Aksesoris" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Aksesoris</th>
                            <th>Stock</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Aksesoris</th>
                            <th>Stock</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama_aksesoris}}</td>
                            <td>{{$data->stock}}</td>
                            <td>@rupiah($data->harga)</td>
                            <td>
                                <a href="{{route('aksesoris.edit',$data->id)}}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{route('aksesoris.delete',$data->id)}}" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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
            $('#Aksesoris').DataTable();
        });
    </script>
@endsection
