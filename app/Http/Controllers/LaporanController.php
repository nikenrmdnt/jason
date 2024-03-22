<?php

namespace App\Http\Controllers;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\PaketWisata;
use app\Models\User;
use PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $reservasi = Reservasi::all();
        return view('laporan.index', [
            'reservasi' => $reservasi
        ]);
    }

    public function downloadpdf(){
        $reservasi = Reservasi::limit(20)->get();
        $pdf = PDF::loadView('laporan.create', compact('reservasi'));
        $pdf -> setPaper ('A4', 'potrait');
        return $pdf->stream('laporan.create');
    }

    public function search(Request $request) { 
        if ($request->start && $request->end && $request->status) 
        { $data = Reservasi::whereBetween('tgl_reservasi_wisata', [$request->start, $request->end])
             ->where('status_reservasi_wisata', $request->status) ->get(); 
        } elseif ($request->start && $request->end){ 
            $data = Reservasi::whereBetween('tgl_reservasi_wisata', [$request->start, $request->end])->get(); 
        } elseif ($request->status) { $data = Reservasi::where('status_reservasi_wisata', $request->status)->get(); 
        } 
        else { $data = Reservasi::get(); } return view('laporan.index', [ 'reservasi' => $data ]); }
}
