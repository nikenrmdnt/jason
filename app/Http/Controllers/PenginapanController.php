<?php

namespace App\Http\Controllers;
use App\Models\Penginapan;
use Illuminate\Http\Request;

class PenginapanController extends Controller
{
    public function index(){
        //Menampilkan Data Guru
        return view('penginapan.index', ['penginapan' => penginapan::all()]);
        } 
        public function create(){
            //Menampilkan Form Tambah Guru
            return view('penginapan.create');
            }
            public function store(Request $request){
            //Menyimpan Data penginapan
            $request->validate([
            'nama_penginapan' => 'required|unique:penginapan,nama_penginapan',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'foto1' => 'required|image|file|max:2048',
            'foto2' => 'required|image|file|max:2048',
            'foto3' => 'required|image|file|max:2048',
            'foto4' => 'required|image|file|max:2048',
            'foto5' => 'required|image|file|max:2048'
            ]);
            $array = $request->only([
            'nama_penginapan',
            'deskripsi',
            'fasilitas'
            ]);
            $array['foto1'] = $request->file('foto1')->store('Foto Paket');
            $array['foto2'] = $request->file('foto2')->store('Foto Paket');
            $array['foto3'] = $request->file('foto3')->store('Foto Paket');
            $array['foto4'] = $request->file('foto4')->store('Foto Paket');
            $array['foto5'] = $request->file('foto5')->store('Foto Paket');
            $tambah= penginapan::create($array);
            if($tambah) $request->file('foto1')->store('Foto Paket');
            return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto2')->store('Foto Paket');
            return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto3')->store('Foto Paket');
            return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto4')->store('Foto Paket');
            return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto5')->store('Foto Paket');
            return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            }
            public function destroy(Request $request, $id)
 {
            //Delete
            $penginapan = Penginapan::find($id);
            if ($penginapan){
            $hapus=$penginapan->delete();
            if($hapus) unlink("storage/" . $penginapan->foto1);
            if($hapus) unlink("storage/" . $penginapan->foto2);
            if($hapus) unlink("storage/" . $penginapan->foto3);
            if($hapus) unlink("storage/" . $penginapan->foto4);
            if($hapus) unlink("storage/" . $penginapan->foto5);
            }
            return redirect()->route('penginapan.index')->with('success_message', 'Berhasil menghapus penginapan ');
 }
 public function edit($id)
    {
        //Menampilkan Form Edit
        $penginapan = penginapan::find($id);
        if (!$penginapan) return redirect()->route('penginapan.index')->with('error_message', 'penginapan dengan id' . $id . ' tidak ditemukan');
        return view('penginapan.edit', [
            'penginapan' => $penginapan
        ]);
    }
    public function update(Request $request, $id)
        {
        //Mengedit Data Standar Kompetensi
        $request->validate([
        'nama_penginapan' =>'required|unique:penginapan,nama_penginapan,'.$id,
        'deskripsi' => 'required',
        'fasilitas' => 'required'
        ]);
        $penginapan = Penginapan::find($id);
        $penginapan->nama_penginapan = $request->nama_penginapan;
        $penginapan->deskripsi = $request->deskripsi;
        $penginapan->fasilitas = $request->fasilitas;
        $penginapan->foto1 = $request->file('foto1')->store('Foto Paket');
        $penginapan->foto2 = $request->file('foto2')->store('Foto Paket');
        $penginapan->foto3 = $request->file('foto3')->store('Foto Paket');
        $penginapan->foto4 = $request->file('foto4')->store('Foto Paket');
        $penginapan->foto5 = $request->file('foto5')->store('Foto Paket');
        $penginapan->save();
        return redirect()->route('penginapan.index')->with('success_message', 'Berhasil mengubah Penginapan');
        }
}