<?php
namespace App\Http\Controllers;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilPelangganController extends Controller
{
    public function index(){
        //Menampilkan Profil Guru
        $pelanggan = Pelanggan::where('id_user', Auth::user()->id)->first();
        return view('profil-pelanggan.index', ['pelanggan' => $pelanggan]);
    } 

    public function edit($id)
        {
        //Menampilkan Form Edit Guru
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) return redirect()->route('profil-pelanggan.index')->with('error_message', 'Pelanggan dengan id = '.$id.' tidak ditemukan');
        return view('profil-pelanggan.edit', [
        'pelanggan' => $pelanggan,
        'users' => User::all()
        ]);
        }
        public function update(Request $request, $id)
        {
        //Mengedit Data Guru
        $request->validate([
        'nama_lengkap' => 'required|unique:pelanggan,nama_lengkap,'.$id,
        'no_hp' => 'required',
        'alamat' => 'required',
        'foto' => $request->file('foto') != null ?'image|file|max:2048' : '',
        'id_user' => 'required'
        ]);
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_lengkap = $request->nama_lengkap;
        $pelanggan->no_hp = $request->no_hp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->id_user = $request->id_user;
        $pelanggan->foto = $request->file('foto')->store('Foto Pelanggan');
        
        if($request->file('foto') != null){
            unlink("storage/" . $pelanggan->foto);
            $pelanggan->foto = $request->file('foto')->store('Foto pelanggan');
            }
            $pelanggan->save();
            return redirect()->route('profil-pelanggan.index')->with('success_message', 'Berhasil mengubah profil pelanggan');
        }
}
