<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBerita;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        //Menampilkan Semua Kategori Wisata
        $kategoriberita = KategoriBerita::all();
        return view('kategoriberita.index', [
            'kategoriberita' => $kategoriberita
        ]);
    }

    public function create()
    {
        //Menampilkan Form Tambah Kategori Wisata
        return view('kategoriberita.create');
    }
    public function store(Request $request)
    {
        //Menyimpan Data Kategori berita
        $request->validate([
            'kategori_berita' => 'required|unique:kategori_berita,kategori_berita'
        ]);
        $array = $request->only([
            'kategori_berita'
        ]);
        $kategoriberita = KategoriBerita::create($array);
        return redirect()->route('kategoriberita.index')->with('success_message', 'Berhasil menambah kategori baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit
        $kategoriberita = KategoriBerita::find($id);
        if (!$kategoriberita)
            return redirect()->route('kategoriberita.index')
                ->with('error_message', 'Kategori Wisata dengan id = ' . $id . ' tidak ditemukan');
        return view('kategoriberita.edit', [
            'kategoriberita' => $kategoriberita
        ]);
    }
    public function update(Request $request, $id)
    {
        //Mengedit Data Kategori Wisata
        $request->validate([
            'kategori_berita' =>
            'required|unique:kategori_berita,kategori_berita,' . $id
        ]);
        $kategoriberita = KategoriBerita::find($id);
        $kategoriberita->kategori_berita = $request->kategori_berita;
        $kategoriberita->save();
        return redirect()->route('kategoriberita.index')->with('success_message', 'Berhasil mengubah Kategori Wisata');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Kategori berita
        $kategoriberita = KategoriBerita::find($id);
        if ($kategoriberita)
            $kategoriberita->delete();
        return redirect()->route('kategoriberita.index')->with('success_message', 'Berhasil menghapus kategor wisata');
    }
}