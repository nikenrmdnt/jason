<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function index(){
        $berita = Berita::all();
        return view('berita.index', [
            'berita' => $berita
        ]);
    }
    public function create()
    {
    //Menampilkan Form Tambah 
    return view(
    'berita.create', [
    'kategori_berita' => KategoriBerita::all() 
    ]);
    }
    public function store(Request $request)
    {
    //Menyimpan Data 
    $request->validate([
    'judul' =>'required',
    'berita'=> 'required',
    'tgl_post'=> 'required',
    'id_kategori_berita'=> 'required',
    'foto'=> 'required|image|file|max:2048'
    ]);
    $array = $request->only([
    'judul', 'berita', 'tgl_post', 'id_kategori_berita'
    ]);
    $array['foto'] = $request->file('foto')->store('Foto Berita');
    $tambah = Berita::create($array);
    if($tambah) $request->file('foto')->store('Foto Berita');
    return redirect()->route('berita.index')->with('success_message', 'Terimakasih telah mengisi data pelanggan ');
    }

    public function destroy(Request $request, $id)
    {
               //Delete
               $berita = berita::find($id);
               if ($berita){
               $hapus=$berita->delete();
               if($hapus) unlink("storage/" . $berita->foto);
               }
               return redirect()->route('berita.index')->with('success_message', 'Berhasil menghapus data berita ');
    }
    public function edit($id)
    {
        //Menampilkan Form Edit
        $berita = Berita::find($id);
        if (!$berita) return redirect()->route('berita.index')
            ->with('error_message', 'Data berita dengan id = ' . $id . ' tidak ditemukan');
        return view('berita.edit', [
            'berita' => $berita,
            'kategori_berita' => KategoriBerita::all() //Mengirimkan semua data bidang studi ke Modal pada halaman edit
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Bidang Studi
        $request->validate([
            'judul' => 'required',
            'berita' => 'required',
            'tgl_post' => 'required',
        ]);
        $berita = Berita::find($id);
        $berita->judul = $request->judul;
        $berita->berita = $request->berita;
        $berita->tgl_post = $request->tgl_post;
        $berita->foto = $request->file('foto')->store('Foto berita');
        $berita->id_kategori_berita = $request->id_kategori_berita;
        $berita->save();
        return redirect()->route('berita.index')->with('success_message', 'Berhasil mengubah berita');
    }
}
