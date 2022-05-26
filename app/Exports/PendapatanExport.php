<?php

namespace App\Exports;

use App\Pesanan;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendapatanExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    public function __construct($start_date , $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    public function collection()
    {
        if($this->start_date==null || $this->end_date==null){
            $datas = Pesanan::all();
        }else{
            $datas = Pesanan::where('status','=','terkirim')
                        ->whereBetween('tgl_pesan',[$this->start_date , $this->end_date])->get();

            $no = 1;
            foreach($datas as $data)

            $items[]=[
                'id'        => $no++,
                'id_pesanan' => $data->customer->nama,
                'id_product' => $data->product->nama,
                'tgl_pesan'   => $data->tgl_pesan,
                'harga_total' => $data->harga_total,
                'status'    => $data->status,
            ];
        }
        return new Collection([
            $items
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama_Customer',
            'Product',
            'Tanggal Pesan',
            'Harga Total',
            'Status Pesanan',
        ];
    }
}
