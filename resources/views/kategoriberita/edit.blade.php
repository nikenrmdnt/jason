@extends('adminlte::page')
@section('title', 'Edit Kategori Berita')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Kategori Berita</h1>
@stop
@section('content')
    <form action="{{ route('kategoriberita.update', $kategoriberita) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="kategoriberita">Kategori Berita</label>
                            <input type="text" class="form-control
@error('kategoriberita') is-invalid @enderror"
                                id="kategori_berita" placeholder="Kategori Wisata" name="kategori_berita"
                                value="{{ $kategori_berita->kategori_berita ?? old('kategori_berita') }}">
                            @error('kategori_berita')
                                <span class="textdanger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kategoriberita.index') }}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @stop
