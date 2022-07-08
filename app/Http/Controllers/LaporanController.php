<?php

namespace App\Http\Controllers;

use App\Exports\PendapatanExport;
use App\Exports\PesananExport;
use App\Exports\QcExport;
use App\Pesanan;
use App\QualityControl;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LaporanController extends Controller
{

    public function pesanan()
    {
        $datas = Pesanan::get();
        return view('laporan.pesanan',compact('datas'));
    }

    public function pesananpdf(Request $request)
    {
        if($request->start_date == null || $request->end_date == null)
        {
            $datas = Pesanan::all();
        }else{
            $datas = Pesanan::whereBetween('tgl_selesai',[$request->start_date,$request->end_date])->get();
        }
        $pdf = PDF::loadView('pdf.pesanan',compact('datas'))->setPaper('A4','landscape');
        return $pdf->stream();
    }

    public function pendapatan()
    {
        $datas = Pesanan::get();
        return view('laporan.pendapatan',compact('datas'));
    }

    public function pendapatanpdf(Request $request)
    {
        if($request->start_date == null || $request->end_date == null)
        {
            $datas = Pesanan::all();
        }else{
            $datas = Pesanan::where('status' == 'selesai')->
                whereBetween('tgl_selesai',[$request->start_date,$request->end_date])->get();
        }
        $pdf = PDF::loadView('pdf.pendapatan',compact('datas'))->setPaper('A4','landscape');
        return $pdf->stream();
    }

    public function quality()
    {
        return view('laporan.quality');
    }

    public function qualitypdf(Request $request)
    {
        if($request->start_date == null || $request->end_date == null)
        {
            $datas = QualityControl::all();
        }else{
            $datas = QualityControl::whereBetween('created_at',[$request->start_date,$request->end_date])->get();
        }
        $pdf = PDF::loadView('pdf.quality',compact('datas'))->setPaper('A4','potrait');
        return $pdf->stream();
    }

}
