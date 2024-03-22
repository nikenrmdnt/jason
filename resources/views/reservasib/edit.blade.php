@extends('adminlte::page')
@section('title', 'Validasi Pembayaran')
@section('content_header')
<h1 class="m-0 text-dark">Validasi Pembayaran</h1>
@stop
@section('content')
<form action="{{route('reservasib.update', $reservasi)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="status_reservasi_wisata">Status</label>
                        <select class="form-select @error('status_reservasi_wisata') isinvalid @enderror" id="status_reservasi_wisata" name="status_reservasi_wisata">
                            <option value="pesan" @if($reservasi->status_reservasi_wisata == 'pesan' ||
                                old('status_reservasi_wisata') == 'pesan')selected @endif>Pesan</option>
                            <option value="dibayar" @if($reservasi->status_reservasi_wisata == 'dibayar' ||
                                old('status_reservasi_wisata') == 'dibayar')selected @endif>Dibayar</option>
                            <option value="selesai" @if($reservasi->status_reservasi_wisata == 'selesai' ||
                                old('status_reservasi_wisata') == 'selesai')selected @endif>Selesai</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{route('reservasib.index')}}" class="btn btn-default">
                    Batal
                </a>
            </div>
        </div>
    </div>
    </div>
    @stop
    @push('js')
    <script>
    $('#example2').DataTable({
        "responsive": true,
    });
    </script>