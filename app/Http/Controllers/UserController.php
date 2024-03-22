<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'users' => $users
        ]);
    }
    public function create()
    {
        //Menampilkan Form Tambah User
        return view('users.create');
    }
    public function store(Request $request)
    {
        //Menyimpan Data User Baru
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'level' => 'required'
        ]);
        $array = $request->only([
            'name',
            'email',
            'password',
            'level',
            'aktif'
        ]);
        $array['password'] = bcrypt($array['password']);
        $user = User::create($array);
        return redirect()->route('users.index')
            ->with('success_message', 'Berhasil menambah user baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit
        $user = User::find($id);
        if (!$user)
            return redirect()->route('users.index')->with('error_message', 'User dengan id' . $id . ' tidak ditemukan');
        return view('users.edit', [
            'user' => $user
        ]);
    }
    public function update(Request $request, $id)
    {
        //Mengedit Data User
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|confirmed',
            'level' => 'required',
            'aktif' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password)
            $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $user->aktif = $request->aktif;
        $user->save();
        return redirect()->route('users.index')->with('success_message', 'Berhasil mengubah user');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus User
        $user = User::find($id);

        if ($id == $request->user()->id)
            return redirect()->route('users.index')->with('error_message', 'Anda tidak dapat menghapus diri sendiri.');
        if ($user)
            $user->delete();
        return redirect()->route('users.index')->with('success_message', 'Berhasil menghapus user');
    }


}