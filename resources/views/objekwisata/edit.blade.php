@extends('adminlte::page') 
@section('title', 'Edit Obyek Wisata') 
@section('content_header') 
    <h1 class="m-0 text-dark">Edit Obyek Wisata</h1>
@stop
@section('content') 
    <form action="{{route('obwis.update', $objekwisata)}}" method="post" enctype="multipart/form-data">
        @method('PUT') 
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                    <label for="nama_wisata">Nama Wisata</label>
                        <input type="text" class="form-control 
@error('nama_wisata') is-invalid @enderror" id="nama_wisata" placeholder="nama_wisata" name="nama_wisata"
                            value="{{$objek_wisata->nama_wisata ??old('nama_wisata')}}">
                        @error('nama_wisata') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_wisata">Deskripsi Wisata</label>
                        <textarea type="text" class="form-control" name="deskripsi_wisata">{{$objek_wisata->deskripsi_wisata ??old('deskripsi_wisata')}}</textarea>
                        @error('deskripsi_wisata') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_kategori_wisata">Kategori Wisata</label>
                        <div class="input-group">
                            <input type="hidden" name="id_kategori_wisata" id="id_kategori_wisata" value="{{old('id_kategori_wisata')}}">
                            <input type="text" class="form-control 
@error('kategori_wisata') is-invalid @enderror" placeholder="Kategori Wisata"
id="kategori_wisata" name="kategori_wisata" value="{{$objek_wisata->kategori_wisata ??old('kategori_wisata')}}" aria-label="Kategori Wisata" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop"></i>
                            Cari Data Kategori Wisata</button>
                        </div>
                        <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <textarea type="text" class="form-control" name="fasilitas">{{$objek_wisata->fasilitas ??old('fasilitas')}}</textarea>
                        @error('fasilitas') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                        <label for="foto1" class="form-label">Foto1</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil1" alt="..." width="10%" id="tampil1">
                        <input class="form-control @error('foto1') is-invalid @enderror" type="file" id="foto1" name="foto1">
                        @error('foto1') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto2" class="form-label">Foto2</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil2" alt="..." width="10%" id="tampil2">
                        <input class="form-control @error('foto2') is-invalid @enderror" type="file" id="foto2" name="foto2">
                        @error('foto2') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto3" class="form-label">Foto3</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil3" alt="..." width="10%" id="tampil3">
                        <input class="form-control @error('foto3') is-invalid @enderror" type="file" id="foto3" name="foto3">
                        @error('foto3') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto4" class="form-label">Foto4</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil4" alt="..." width="10%" id="tampil4">
                        <input class="form-control @error('foto4') is-invalid @enderror" type="file" id="foto4" name="foto4">
                        @error('foto4') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto5" class="form-label">Foto5</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil5" alt="..." width="10%" id="tampil5">
                        <input class="form-control @error('foto5') is-invalid @enderror" type="file" id="foto5" name="foto5">
                        @error('foto5') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('obwis.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"
id="staticBackdropLabel">Pencarian Data Kategori Wisata</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                            <tr>
                            <th>No.</th>
                            <th>Kategori Wisata</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($katwis as $key => $kw)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$kw->kategori_wisata}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary 
btn-xs" onclick="pilih('{{$kw->id}}', '{{$kw->kategori_wisata}}')" data-bs-dismiss="modal">
                                            Pilih
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
        
        function pilih(id, kategori_wisata){
            document.getElementById('id_kategori_wisata').value = id
            document.getElementById('kategori_wisata').value = kategori_wisata
        }

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto1").change(function () {
            readURL1(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto2").change(function () {
            readURL2(this);
        });

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil3').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto3").change(function () {
            readURL3(this);
        });

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil4').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto4").change(function () {
            readURL4(this);
        });

        function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil5').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto5").change(function () {
            readURL5(this);
        });
    </script>  
@endpush