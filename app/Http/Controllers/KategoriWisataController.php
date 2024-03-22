<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriWisata;

class KategoriWisataController extends Controller
{
    public function index()
    {
        //Menampilkan Semua Kategori Wisata
        $kategoriwisata = KategoriWisata::all();
        return view('kategoriwisata.index', [
            'kategoriwisata' => $kategoriwisata
        ]);
    }

    public function create()
    {
        //Menampilkan Form Tambah Kategori Wisata
        return view('kategoriwisata.create');
    }
    public function store(Request $request)
    {
        //Menyimpan Data Bidang Studi
        $request->validate([
            'kategori_wisata' => 'required|unique:kategori_wisata,kategori_wisata'
        ]);
        $array = $request->only([
            'kategori_wisata'
        ]);
        $kategoriwisata = KategoriWisata::create($array);
        return redirect()->route('kategoriwisata.index')->with('success_message', 'Berhasil menambah kategori baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit
        $kategoriwisata = KategoriWisata::find($id);
        if (!$kategoriwisata)
            return redirect()->route('kategoriwisata.index')
                ->with('error_message', 'Kategori Wisata dengan id = ' . $id . ' tidak ditemukan');
        return view('kategoriwisata.edit', [
            'kategoriwisata' => $kategoriwisata
        ]);
    }
    public function update(Request $request, $id)
    {
        //Mengedit Data Kategori Wisata
        $request->validate([
            'kategori_wisata' =>
            'required|unique:kategori_wisata,kategori_wisata,' . $id
        ]);
        $kategoriwisata = KategoriWisata::find($id);
        $kategoriwisata->kategori_wisata = $request->kategori_wisata;
        $kategoriwisata->save();
        return redirect()->route('kategoriwisata.index')->with('success_message', 'Berhasil mengubah Kategori Wisata');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi
        $kategoriwisata = KategoriWisata::find($id);
        if ($kategoriwisata)
            $kategoriwisata->delete();
        return redirect()->route('kategoriwisata.index')->with('success_message', 'Berhasil menghapus kategor wisata');
    }
}