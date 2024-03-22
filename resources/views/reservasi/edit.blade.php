@extends('adminlte::page')
@section('title', 'Form Pembayaran')
@section('content_header')
<h1 class="m-0 text-dark">Form Pembayaran</h1>
@stop
@section('content')
<form action="{{route('reservasi.update', $reservasi)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                        <div class="form-group">
                        <label for="file_bukti_tf" class="formlabel">File Bukti Transfer</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil" alt="..." width="15%"
                            id="tampil">
                        <input class="form-control @error('file_bukti_tf') is-invalid @enderror" type="file" id="file_bukti_tf"
                            name="file_bukti_tf">
                        @error('file_bukti_tf') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('reservasi.index')}}" class="btn btn-default">
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
    @push('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new
                FileReader();
                reader.onload = function(e) {
                    $('#tampil').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file_bukti_tf").change(function() {
            readURL(this);
        });
    </script>
    @endpush