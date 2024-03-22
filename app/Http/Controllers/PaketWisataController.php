<?php

namespace App\Http\Controllers;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index(){
        //Menampilkan Data Guru
        return view('paketwisata.index', ['paket_wisata' => PaketWisata::all()]);
        } 
        public function create(){
            //Menampilkan Form Tambah Guru
            return view('paketwisata.create');
            }
            public function store(Request $request){
            //Menyimpan Data paketwisata
            $request->validate([
            'nama_paket' => 'required|unique:paket_wisata,nama_paket',
            'deskripsi' => 'required',
            'fasilitas' => 'required',
            'harga_per_pack' => 'required',
            'diskon' => 'required',
            'foto1' => 'required|image|file|max:2048',
            'foto2' => 'required|image|file|max:2048',
            'foto3' => 'required|image|file|max:2048',
            'foto4' => 'required|image|file|max:2048',
            'foto5' => 'required|image|file|max:2048'
            ]);
            $array = $request->only([
            'nama_paket',
            'deskripsi',
            'fasilitas',
            'harga_per_pack',
            'diskon'
            ]);
            $array['foto1'] = $request->file('foto1')->store('Foto Wisata');
            $array['foto2'] = $request->file('foto2')->store('Foto Wisata');
            $array['foto3'] = $request->file('foto3')->store('Foto Wisata');
            $array['foto4'] = $request->file('foto4')->store('Foto Wisata');
            $array['foto5'] = $request->file('foto5')->store('Foto Wisata');
            $tambah= PaketWisata::create($array);
            if($tambah) $request->file('foto1')->store('Foto Wisata');
            return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto2')->store('Foto Wisata');
            return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto3')->store('Foto Wisata');
            return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto4')->store('Foto Wisata');
            return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            if($tambah) $request->file('foto5')->store('Foto Wisata');
            return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil menambah Paket Wisata');
            }
            
            public function destroy(Request $request, $id)
 {
            //Delete
            $paketwisata = PaketWisata::find($id);
            if ($paketwisata){
            $hapus=$paketwisata->delete();
            if($hapus) unlink("storage/" . $paketwisata->foto1);
            if($hapus) unlink("storage/" . $paketwisata->foto2);
            if($hapus) unlink("storage/" . $paketwisata->foto3);
            if($hapus) unlink("storage/" . $paketwisata->foto4);
            if($hapus) unlink("storage/" . $paketwisata->foto5);
            }
            return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil menghapus Paket Wisata ');
        }
        public function edit($id)
        {
        //Menampilkan Form Edit
        $paketwisata = PaketWisata::find($id);
        if (!$paketwisata) return redirect()->route('paketwisata.index')->with('error_message', 'paketwisata dengan id' . $id . ' tidak ditemukan');
        return view('paketwisata.edit', [
            'paketwisata' => $paketwisata
        ]);
    }
    public function update(Request $request, $id)
        {
        //Mengedit Data Standar Kompetensi
        $request->validate([
        'nama_paket' =>'required|unique:paket_wisata,nama_paket,'.$id,
        'deskripsi' => 'required',
        'fasilitas' => 'required',
        'harga_per_pack' => 'required',
        'diskon' => 'required'
        ]);
        $paketwisata = PaketWisata::find($id);
        $paketwisata->nama_paket = $request->nama_paket;
        $paketwisata->deskripsi = $request->deskripsi;
        $paketwisata->fasilitas = $request->fasilitas;
        $paketwisata->harga_per_pack = $request->harga_per_pack;
        $paketwisata->diskon = $request->diskon;
        $paketwisata->foto1 = $request->file('foto1')->store('Foto Paket');
        $paketwisata->foto2 = $request->file('foto2')->store('Foto Paket');
        $paketwisata->foto3 = $request->file('foto3')->store('Foto Paket');
        $paketwisata->foto4 = $request->file('foto4')->store('Foto Paket');
        $paketwisata->foto5 = $request->file('foto5')->store('Foto Paket');
        $paketwisata->save();
        return redirect()->route('paketwisata.index')->with('success_message', 'Berhasil mengubah Paket Wisata');
        }

 
}
