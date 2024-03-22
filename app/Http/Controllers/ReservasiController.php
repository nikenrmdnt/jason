<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\PaketWisata;
use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReservasiController extends Controller
{
    public function index(){
        if (Auth::user()->pelanggan) {
            $data = Reservasi::where('id_pelanggan', Auth::user()->pelanggan->id)->get();
        } else {
            $data = Reservasi::get();
        }
        return view('reservasi.index', [
            'data' => $data,
            'paketwisata' => PaketWisata::get(),
            'pelanggan' => Pelanggan::get()
        ]);
    }

    public function create()
    {

        //Menampilkan Form Tambah 
        return view(
            'reservasi.create',
            [
                'pelanggan' => Pelanggan::all(),
                'paketwisata' => PaketWisata::all()
            ]
        );
    }

    public function store(Request $request)
    {
    //Menyimpan Data 
    $request->validate([
    'id_pelanggan' =>'required',
    'id_paket'=> 'required',
    'tgl_reservasi_wisata'=> 'required',
    'harga' => 'required',
    'jumlah_peserta'=> 'required',
    'diskon'=> 'required',
    'nilai_diskon'=> 'required',
    'total_bayar'=> 'required',
    'status_reservasi_wisata'=> 'pesan',
    ]);
    $array = $request->only([
    'id_pelanggan', 'id_paket', 'tgl_reservasi_wisata', 'harga', 'jumlah_peserta', 'diskon', 'nilai_diskon', 'total_bayar', 'status_reservasi_wisata'
    ]);
    $tambah = Reservasi::create($array);
    return redirect()->route('reservasi.index')->with('success_message', 'Terimakasih telah melakukan reservasi ');
    }
    
    public function edit($id)
    {
        //Menampilkan Form Edit
        $reservasi = reservasi::find($id);
        if (!$reservasi) return redirect()->route('reservasi.index')
            ->with('error_message', 'Data reservasi dengan id = ' . $id . ' tidak ditemukan');
        return view('reservasi.edit', [
            'reservasi' => $reservasi,
            'users' => User::all(),
            'paketwisata' => PaketWisata::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::find($id);
        $reservasi->file_bukti_tf = $request->file('file_bukti_tf')->store('File Bukti Transaksi');
        $reservasi->save();
        return redirect()->route('reservasi.index')->with('success_message', 'Pembayaran Mu Telah Diperoses Silahkan Tunggu');
    }


}
