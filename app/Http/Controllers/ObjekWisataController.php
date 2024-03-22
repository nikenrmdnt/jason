<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\KategoriWisata;

class ObjekWisataController extends Controller
{
    public function index()
    {
        //Menampilkan Data Obyek_Wisata
        $obwis = objekwisata::all();
        return view('objekwisata.index', [ 
            'objekwisata' => $obwis
        ]);
    }

    public function create()
    { 
        //Menampilkan Form Tambah obyek_wisata
        return view( 
            'objekwisata.create', [ 
            'katwis' => KategoriWisata::all() //Mengirimkan semua data Kategori wisata ke Modal pada halaman create
        ]);
    }

    public function store(Request $request)
    { 
        //Menyimpan Data obyek_wisata
        $request->validate([
            'nama_wisata' => 'required', 
            'deskripsi_wisata' => 'required',
            'id_kategori_wisata' => 'required',
            'fasilitas'=> 'required',
            'foto1' => 'required',
            'foto2' => 'required',
            'foto3' => 'required',
            'foto4' => 'required',
            'foto5' => 'required'
        ]);
        $array = $request->only([
            'nama_wisata', 'deskripsi_wisata', 'id_kategori_wisata', 'fasilitas', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'
        ]);

        $array['foto1'] = $request->file('foto1')->store('Foto Obyek Wisata');
        $array['foto2'] = $request->file('foto2')->store('Foto Obyek Wisata');
        $array['foto3'] = $request->file('foto3')->store('Foto Obyek Wisata');
        $array['foto4'] = $request->file('foto4')->store('Foto Obyek Wisata');
        $array['foto5'] = $request->file('foto5')->store('Foto Obyek Wisata');
        $tambah = objekwisata::create($array);
        if($tambah) $request->file('foto1')->store('Foto Obyek Wisata');
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil menambah obyek wisata baru');
        if($tambah) $request->file('foto2')->store('Foto Obyek Wisata');
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil menambah obyek wisata baru');
        if($tambah) $request->file('foto3')->store('Foto Obyek Wisata');
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil menambah obyek wisata baru');
        if($tambah) $request->file('foto4')->store('Foto Obyek Wisata');
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil menambah obyek wisata baru');
        if($tambah) $request->file('foto5')->store('Foto Obyek Wisata');
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil menambah obyek wisata baru');
    } 

    public function edit($id)
    { 
        //Menampilkan Form Edit
        $obwis = objekwisata::find($id);
        if (!$obwis) return redirect()->route('obwis.index') 
        ->with('error_message', 'kategori wisata dengan id = '.$id.' tidak ditemukan');
        return view('objekwisata.edit', [ 
            'objekwisata' => $obwis,
            'katwis' => KategoriWisata::all() 
        ]);
    } 

    public function update(Request $request, $id)
    { 
        //Mengedit Data obyek_wisata
        $request->validate([
            'nama_wisata' => 'required', 
            'deskripsi_wisata' => 'required',
            'id_kategori_wisata' => 'required',
            'fasilitas'=> 'required',
            'foto1' => 'required',
            'foto2' => 'required',
            'foto3' => 'required',
            'foto4' => 'required',
            'foto5' => 'required'
        ]);
        $katwis = objekwisata::find($id);
        $katwis->nama_wisata = $request->nama_wisata;
        $katwis->deskripsi_wisata = $request->deskripsi_wisata;
        $katwis->id_kategori_wisata = $request->id_kategori_wisata;
        $katwis->fasilitas = $request->fasilitas;
        $katwis->foto1 = $request->file('foto1')->store('Foto Obyek Wisata');
        $katwis->foto2 = $request->file('foto2')->store('Foto Obyek Wisata');
        $katwis->foto3 = $request->file('foto3')->store('Foto Obyek Wisata');
        $katwis->foto4 = $request->file('foto4')->store('Foto Obyek Wisata');
        $katwis->foto5 = $request->file('foto5')->store('Foto Obyek Wisata');
        $katwis->save();
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil mengubah obyek wisata');
    }

    public function destroy(Request $request, $id)
    { 
        //Menghapus Obyek Wisata
        $obwis = objekwisata::find($id);
        if ($obwis){
            $hapus=$obwis->delete();
        if($hapus) unlink("storage/app/public/Foto Obyek Wisata" . $obwis->foto1);
        if($hapus) unlink("storage/app/public/Foto Obyek Wisata" . $obwis->foto2);
        if($hapus) unlink("storage/app/public/Foto Obyek Wisata" . $obwis->foto3);
        if($hapus) unlink("storage/app/public/Foto Obyek Wisata" . $obwis->foto4);
        if($hapus) unlink("storage/app/public/Foto Obyek Wisata" . $obwis->foto5);
        }
        return redirect()->route('obwis.index')->with('success_message', 'Berhasil menghapus obyek wisata');
    }
}