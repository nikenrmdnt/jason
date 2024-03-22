@extends('adminlte::page')
@section('title', 'Laman Pengisian Data Karyawan')
@section('content_header')
<h1 class="m-0 text-dark">Pengisian Data Karyawan</h1>
@stop
@section('content')
<form action="{{route('karyawan.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror" id="nama_karyawan" placeholder="Nama Lengkap" name="nama_karyawan"
                            value="{{old('nama_karyawan')}}">
                        @error('nama_karyawan') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea rows="5" placeholder="Alamat"
                            class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat">{{old('alamat')}}</textarea> @error('alamat') <span
                            class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp">Nomor HandPhone</label>
                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            placeholder="Nomor HP" name="no_hp" value="{{old('no_hp')}}"> @error('no_hp') <span
                            class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div id="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select @error('jabatan') isinvalid @enderror">
                            <option value="administrator" @if(old ("jabatan") == 'administrator') selected @endif>Admin</option>
                            <option value="bendahara" @if(old ("jabatan") == 'bendahara') selected @endif>Bendahara</option>
                            <option value="pemilik" @if(old ("jabatan") == 'pemilik') selected @endif>Pemilik</option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id">Email</label>
                        <div class="input-group">
                            <input type="hidden" name="id_user" id="id_user" value="{{old('id_user')}}">
                            <input type="text" class="form-control @error('users') is-invalid @enderror" placeholder="Email" id="users" name="users" value="{{old('users')}}"
                                arialabel="Id User" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari"
                                data-bs-target="#staticBackdrop"></i>
                                Cari Email</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('karyawan.index')}}" class="btn
btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bsbackdrop="static" data-bs-keyboard="false" tabindex="-1"
        arialabelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table table-hover table-bordered tablestripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs"
                                        onclick="pilih('{{$user->id}}', '{{$user->email}}')" data-bs-dismiss="modal">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    @stop
    @push('js')
    <script>
    $('#example2').DataTable({
        "responsive": true,
    });
    //Fungsi pilih untuk memilih data bidang studi dan mengirimkan
    function pilih(id, user) {
        document.getElementById('id_user').value = id
        document.getElementById('users').value = user
    }
    </script>
    @endpush