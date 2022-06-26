<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang Rusak</title>
</head>
<body>
        <div style="display: flex; align-items: center; margin-bottom:-30px">
            <h2 style="text-align:center;">Laporan Barang Rusak</h2>
        </div>
        <br>
    <table style="text-align: center; " border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Nama Product</th>
                <th> Keterangan</th>
                <th>Barang Rusak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data )
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$data->pesanan->customer->nama}}</td>
                <td>{{$data->pesanan->product->nama}}</td>
                <td>{{strtoupper($data->ket)}}</td>
                <td>{{$data->barang_rusak}}</td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="4"><b>Total</b></td>
            <td>{{$data->sum('barang_rusak')}}</td>
        </tr>
    </table>

</body>
</html>
