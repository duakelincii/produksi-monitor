<?php

namespace App\Exports;

use App\Pesanan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesananExport implements FromCollection , WithHeadings ,ShouldAutoSize
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
            $datas = Pesanan::whereBetween('tgl_pesan',[$this->start_date , $this->end_date])->get();

            $no = 1;
            foreach($datas as $data)

            $items[]=[
                'id'        => $no++,
                'id_customer' => $data->customer->nama,
                'quantity'  => $data->quantity,
                'harga_total' => $data->harga_total,
                'tgl_pesan' => $data->tgl_pesan,
                'tgl_selesai' => $data->tgl_selesai,
                'status'    => $data->status,
            ];
        }
        if($datas != null){
            return new Collection([
                $items
            ]);
        }else{
            return redirect(route('pesanan'))->with('error','Tidak Ada Data');
        }
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama_Customer',
            'Jumlah Pesanan',
            'Harga Total',
            'Tanggal Pesan',
            'Tanggal Selesai',
            'Status Pesanan',
        ];
    }
}
