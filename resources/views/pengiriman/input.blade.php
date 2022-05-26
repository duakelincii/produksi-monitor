    @extends('layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pesanan Baru</h6>
        </div>
        <div class="card-body">
            <form class="user" action="{{ route('pengiriman.simpan') }}" method="post">
                @csrf
                <div class="form-group row">
                    @foreach ($items as $key => $data)
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="id_pesanan" value="{{ $data->id }}">
                        <input type="hidden" name="id_customer" value="{{ $data->customer->id }}">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="nama_customer">No Pesanan <span style="color: red">*</span></label>
                            <input type="text" value="{{ $data->kode }}" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="nama_customer">Nama Customer <span style="color: red">*</span></label>
                            <input type="text" value="{{ $data->customer->nama }}" class="form-control" readonly>
                        </div>
                    @endforeach
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Tanggal Jalan <span style="color: red">*</span></label>
                        <div class="input-group mb-2">
                            <input type="datetime-local" class="form-control" name="tgl_kirim" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Nama Supir <span style="color: red">*</span></label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control " name="nama_supir" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">No Kendaraan <span style="color: red">*</span></label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="no_kendaraan" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="{{ route('pengiriman') }}" class="btn btn-danger btn-block btn">
                            <i class="fas fa-arrow-left fa-fw"></i> Kembali
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save fa-fw"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
