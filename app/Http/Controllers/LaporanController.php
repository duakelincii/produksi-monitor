<?php

namespace App\Http\Controllers;

use App\Exports\PendapatanExport;
use App\Exports\PesananExport;
use App\Exports\QcExport;
use App\Pesanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    public function pesanan()
    {
        $datas = Pesanan::get();
        return view('laporan.pesanan',compact('datas'));
    }

    public function pesananexport($start_date,$end_date)
    {
        return Excel::download(new PesananExport($start_date , $end_date),time().'.xlsx');
    }

    public function pendapatan()
    {
        $datas = Pesanan::get();
        return view('laporan.pendapatan',compact('datas'));
    }

    public function pendapatanexport($start_date,$end_date)
    {
        return Excel::download(new PendapatanExport($start_date , $end_date),time().'.xlsx');
    }

    public function quality()
    {
        return view('laporan.quality');
    }

    public function qualityExport($start_date,$end_date)
    {
        return Excel::download(new QcExport($start_date , $end_date),time().'.xlsx');
    }

}
