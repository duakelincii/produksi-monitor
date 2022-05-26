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
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="{{ $data->id }}">Proses</a>
                                @elseif ($data->status == 'lunas')
                                <a href="{{route('purchasing.stockin',$data->id)}}" class="btn btn-success btn-sm">stock In</a>
                                @elseif ($data->status == 'selesai')
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Status Proses Pesanan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('purchasing.status')}}" method="POST">
                  @csrf
                  @foreach ($datas as $data )
                  <input type="hidden" name="id" value="{{$data->id}}">
                  @endforeach
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Status Quality Control</label>
                        <div class="input-group mb-2">
                            <select name="status" id="" class="form-control">
                                <option value=""></option>
                                <option value="belum lunas">Belum Lunas</option>
                                <option value="lunas">Lunas</option>
                                <option value="jatuh tempo">Jatuh Tempo</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <a href="" class="btn btn-danger btn-block btn"> Kembali
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-block"> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#pesanan').DataTable();
        });
    </script>
@endsection
