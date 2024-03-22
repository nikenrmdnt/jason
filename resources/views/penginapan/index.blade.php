@extends('adminlte::page')
@section('title', 'List Penginapan')
@section('content_header')
<h1 class="m-0 text-dark">List Penginapan</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card overflow-scroll">
            <div class="card-body pe-3">
                <a href="{{route('penginapan.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>
                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Penginapan</th>
                            <th>Deskripsi</th>
                            <th>Fasilitas</th>
                            <th>Foto 1</th>
                            <th>Foto 2</th>
                            <th>Foto 3</th>
                            <th>Foto 4</th>
                            <th>Foto 5</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penginapan as $key => $bs)
                        <tr>
                            <td>{{$key+1}}</td>
                            <!-- <td>{{$bs->id}}</td> -->
                            <td>{{$bs->nama_penginapan}}</td>
                            <td>{{$bs->deskripsi}}</td>
                            <td>{{$bs->fasilitas}}</td>
                            <td>
                            <img src="storage/{{$bs->foto1}}"alt="{{$bs->foto1}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$bs->foto2}}"alt="{{$bs->foto2}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$bs->foto3}}"alt="{{$bs->foto3}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$bs->foto4}}"alt="{{$bs->foto4}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$bs->foto5}}"alt="{{$bs->foto5}}" class="img-thumbnail"></td>
                            <td>
                                <a href="{{route('penginapan.edit', $bs)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('penginapan.destroy', $bs)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
$('#example2').DataTable({
    "responsive": true,
});

function notificationBeforeDelete(event, el) {
    event.preventDefault();
    if (confirm('Apakah anda yakin akan menghapus data ? ')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush