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
               <font size="4"><b>SURAT JALAN </b></font>
            </table>
            <br>
            <table cellspacing="0" width="100%">
                <tr>
                    <td>No Surat Jalan</td>
                    <td> : {{$sj}}</td>
                    <td>Nama Pengirim</td>
                    <td> : {{strtoupper($datas->nama_supir)}}</td>
                </tr>
                <tr>
                    <td>Nama Customer</td>
                    <td> : {{$datas->customer->nama}}</td>
                    <td>No Kendaraan</td>
                    <td> : {{$datas->no_kendaraan}}</td>
                </tr>
                <tr>
                    <td>Tanggal Kirim</td>
                    <td> : {{\Carbon\Carbon::parse($datas->tgl_kirim)->isoFormat('D MMMM Y')}}</td>
                    <td>No Pesanan</td>
                    <td> : {{$datas->pesanan->kode}}</td>
                </tr>
                <tr>
                    <td>No Handphone</td>
                    <td> : {{$datas->customer->phone}}</td>
                    <td>Tanggal Pesan</td>
                    <td> : {{\Carbon\Carbon::parse($datas->tgl_pesan)->isoFormat('D MMMM Y')}}</td>
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
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?= $no = 1;?>
            <tr>
                <td>{{$no++}}</td>
                <td>{{$datas->pesanan->product->nama_product}}</td>
                <td>{{$datas->pesanan->barang_ready}}</td>
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
