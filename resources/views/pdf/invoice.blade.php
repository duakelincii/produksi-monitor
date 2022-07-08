<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Surat Jalan</title>
    <style type="text/css">

        @page {
            margin: 0cm 0cm;
        }
        body {
            margin-top: 2cm;
            margin-left: 3cm;
            margin-right: 3cm;
            margin-bottom: 3cm;
            color: #000;
        }

        hr.s7{
            height: 1px;
            border-top: 2px solid black;
            border-bottom: 1px solid black;
        }

        hr.s1{
            border-top: 1px solid black;
        }

        table tr th{
            background-color: rgb(61, 113, 255);
            font-size: 15px;
        }

        table tr td{
            font-size: 15px;
        }

        p {
            font-size: 15px;
        }
    </style>

<table>
    <tr>
        <td align="center">
            <font size="5" style="color: blue">PT CIPTA GRACIA LESTARI</font><br>
            <font size="3"><i> Alamat : city square, Jl. Peta Selatan No.19, RT.10/RW.1, Kalideres, Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11840 </i></font><br>
            <font size="2">Telp. (021) 29666764 Email. info@ciptagracia.co.id</font><br>
            <font size="2">DKI Jakarta - Indonesia</font>
        </td>
    </tr>
</table>
<hr class="s1">
    <br>
    <table>
        <tr>
            <td align="center" width="430">
               <font size="4"><b>INVOICE PESANAN</b></font>
            </table>
            <br>
            <table cellspacing="0" width="100%">
                <tr>
                    <td>No Pesanan</td>
                    <td> : {{$datas->kode}}</td>
                    <td>Tanggal Selesai</td>
                    <td> : {{\Carbon\Carbon::parse($datas->tgl_selesai)->isoFormat('D MMMM Y')}}</td>
                </tr>
                <tr>
                    <td>Nama Customer</td>
                    <td> : {{$datas->customer->nama}}</td>

                </tr>
                <tr>
                    <td>Tanggal Pesan</td>
                    <td> : {{\Carbon\Carbon::parse($datas->tgl_pesan)->isoFormat('D MMMM Y')}}</td>
                </tr>
                <tr>
                    <td>No Handphone</td>
                    <td> : {{$datas->customer->phone}}</td>
                </tr>
            </table>
            </td>
        </tr>
    </table>
    <br>
    <hr class="s1">
    <table style="text-align: center; "  cellspacing="0" cellpadding="5" width="100%" >
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Harga Item</th>
                <th>Qty</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?= $no = 1;?>
            <?= $subtotal = $datas->product->harga_jual * $datas->barang_ready; ?>
            <tr>
                <td>{{$no++}}</td>
                <td>{{$datas->product->nama_product}}</td>
                <td>{{$datas->product->harga_jual}}</td>
                <td>{{$datas->barang_ready}}</td>
                <td>@rupiah($subtotal)</td>
            </tr>
            <tr>
                <th></th>
                <th colspan="3">Total</th>
                <th>@rupiah($subtotal)</th>
            </tr>
        </tbody>
    </table>
    <hr class="s1">
    <table>
        <tr>
            <td width="420">
                <font size="1">Terima kasih atas pembelian produk PT CIPTA GRACIA LESTARI</font>
            </td>
        </tr>
    </table>
    <table >
        <tr>
            <td width="420" align="right">
                <font size="2">Jakarta , {{\Carbon\Carbon::now()->isoFormat('D MMMM Y')}}</font><br><br><br><br>
                <font>(Penerima)</font>
            </td>
        </tr>
    </table>
</head>

<body>

</body>

</html>
