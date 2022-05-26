<?php

namespace App\Exports;

use App\QualityControl;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QcExport implements FromCollection , WithHeadings , ShouldAutoSize
{
    public function __construct($start_date , $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }


    public function collection()
    {
        if($this->start_date==null || $this->end_date==null){
            $datas = QualityControl::get();
        }else{
            $datas = QualityControl::where('status','=','selesai')
            ->whereBetween('created_at',[$this->start_date , $this->end_date])->get();

            $no = 1;
            foreach($datas as $data)
            $items[]=[
                'id'        => $no++,
                'id_pesanan' => $data->customer->nama,
                'id_product' => $data->product->nama,
                'barang_rusak' => $data->barang_rusak,
                'ket'       => $data->ket
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
            'Nama Product',
            'Barang Rusak',
            'Keterangan',
        ];
    }

}
