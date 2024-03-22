<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\PaketWisata;
use app\Models\User;

class Reservasib extends Controller
{
    public function index(){
        $reservasi = Reservasi::all();
        return view('reservasib.index', [
            'reservasi' => $reservasi
        ]);
    }

    public function edit($id)
    {
        //Menampilkan Form Edit
        $reservasi = reservasi::find($id);
        if (!$reservasi) return redirect()->route('reservasib.index')
            ->with('error_message', 'Data reservasi dengan id = ' . $id . ' tidak ditemukan');
        return view('reservasib.edit', [
            'reservasi' => $reservasi,
            'users' => User::all(),
            'paketwisata' => PaketWisata::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::find($id);
        $reservasi->status_reservasi_wisata = $request->status_reservasi_wisata;
        $reservasi->save();
        return redirect()->route('reservasib.index')->with('success_message', 'Pembayaran Telah di Validasi');
    }
}
