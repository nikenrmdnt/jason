<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\User;
class KaryawanController extends Controller
{
    public function index(){
        //Menampilkan Data 
        return view('karyawan.index', ['karyawan' => karyawan::all()]);
        } 
        public function create()
        {


        //Menampilkan Form Tambah 
        return view(
        'karyawan.create', [
        'users' => User::all() 
        ]);
        }
        public function store(Request $request){
        
        //Menyimpan Data 
        $request->validate([
        'nama_karyawan' =>'required',
        'alamat'=> 'required',
        'no_hp'=> 'required',
        'id_user'=> 'required',
        ]);
        $array = $request->only([
        'nama_karyawan', 'alamat', 'no_hp', 'id_user'
        ]);
        Karyawan::create($array);
        return redirect()->route('karyawan.index')->with('success_message', 'Berhasil menambah data karyawan baru!!');
        }

        public function edit($id)
        {
        //Menampilkan Form Edit
        $karyawan = Karyawan::find($id);
        if (!$karyawan) return redirect()->route('karyawan.index')
        ->with('error_message', 'Karyawan dengan id = '.$id.'
        tidak ditemukan');
        return view('karyawan.edit', [
        'karyawan' => $karyawan,
        'users' => User::all() //Mengirimkan semua data bidang studi ke Modal pada halaman edit
        ]);
        }
        public function update(Request $request, $id)
        {
        //Mengedit Data Standar Kompetensi
        $request->validate([
            'nama_karyawan' =>'required',
            'alamat'=> 'required',
            'no_hp'=> 'required',
            'jabatan' => 'required'
        ]);
        $karyawan = Karyawan::find($id);
        $karyawan->nama_karyawan = $request->karyawan;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->id_user = $request->id_user;
        $karyawan->save();
        return redirect()->route('karyawan.index')->with('success_message', 'Berhasil mengubah Karyawan');
        } 

        public function destroy(Request $request, $id)
        {
        //Menghapus
        $karyawan = Karyawan::find($id);
        if ($karyawan) $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success_message', 'Berhasil menghapus Karyawan "' . $karyawan->nama_karyawan . '" !');
        }
}
