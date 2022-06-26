<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pesanan</title>
</head>
<body>
        <div style="display: flex; align-items: center; margin-bottom:-30px">
            <h2 style="text-align:center;">Laporan Pesanan </h2>
        </div>
    <table style="text-align: center; " border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Nama Product</th>
                <th>Quantity</th>
                <th>Barang QC</th>
                <th>Tanggal Pesan</th>
                <th>Tanggal Selesai</th>
                <th>Tanggal Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data )
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$data->customer->nama}}</td>
                <td>{{\Carbon\Carbon::parse($data->tgl_order)->isoFormat('D MMMM Y')}}</td>
                <td>{{\Carbon\Carbon::parse($data->tgl_selesai)->isoFormat('D MMMM Y')}}</td>
                <td>{{\Carbon\Carbon::parse($data->tgl_tempo)->isoFormat('D MMMM Y')}}</td>
                <td>{{$data->product->nama}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->barang_ready}}</td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="7">Total</td>
            <td>@rupiah($data->sum('barang_ready'))</td>
        </tr>
    </table>

</body>
</html>
