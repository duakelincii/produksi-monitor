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
                <table class="table table-bordered" id="produk" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Nama Product</th>
                            <th>Stock</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Nama Product</th>
                            <th>Stock</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama_bahan}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->stock}}</td>
                            <td>@rupiah($data->harga_beli)</td>
                            <td>@rupiah($data->harga_jual)</td>
                            <td>
                                <a href="{{route('product.edit',$data->id)}}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{route('product.delete',$data->id)}}" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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
            $('#produk').DataTable();
        });
    </script>
@endsection
