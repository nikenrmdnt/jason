<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = pelanggan::all();
        return view('pelanggan.index', [
            'pelanggan' => $pelanggan
        ]);
    }

    public function create()
    {
        //Menampilkan Form Tambah Mata Pelajaran
        return view(
            'pelanggan.create',
            [
                'users' => User::all()   //Mengirimkan semua data bidang studi ke Modal pada halaman create
            ]
        );
    }
    public function store(Request $request)
    {
        //Menyimpan Data pelanggan
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|file|max:2048',
            'id_user' => 'required'
        ]);
        $array = $request->only([
            'nama_pelanggan',
            'no_hp',
            'alamat',
            'foto',
            'id_user'
        ]);

        $array['foto'] = $request->file('foto')->store('Foto Pelanggan');
        $tambah = Pelanggan::create($array);
        if ($tambah) $request->file('foto')->store('Foto Pelanggan');
        return redirect()->route('pelanggan.index')->with('success_message', 'Berhasil menambah pelanggan baru');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus pelanggan
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $hapus = $pelanggan->delete();
            if ($hapus) unlink("storage/" . $pelanggan->foto);
        }
        return redirect()->route('pelanggan.index')->with('success_message', 'Berhasil menghapus pelanggan "' . $pelanggan->name . '" !');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) return redirect()->route('pelanggan.index')
            ->with('error_message', 'Data pelanggan dengan id = ' . $id . ' tidak ditemukan');
        return view('pelanggan.edit', [
            'pelanggan' => $pelanggan,
            'users' => User::all() //Mengirimkan semua data bidang studi ke Modal pada halaman edit
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Bidang Studi
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => $request->file('foto') != null ?
                'image|file|max:2048' : '',

        ]);
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->no_hp = $request->no_hp;
        $pelanggan->id_user = $request->id_user;
        if ($request->file('foto') != null) {
            unlink("storage/" . $pelanggan->foto);
            $pelanggan->foto = $request->file('foto')->store('Foto pelanggan');
        }
        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success_message', 'Berhasil mengubah pelanggan');
    }
}