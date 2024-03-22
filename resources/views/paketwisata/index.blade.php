@extends('adminlte::page')
@section('title', 'List Paket Wisata')
@section('content_header')
<h1 class="m-0 text-dark">List Paket Wisata</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card overflow-scroll">
            <div class="card-body pe-3">
                <a href="{{route('paketwisata.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>
                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Paket</th>
                            <th>Deskripsi</th>
                            <th>Fasilitas</th>
                            <th>Harga Paket</th>
                            <th>Diskon</th>
                            <th>Foto 1</th>
                            <th>Foto 2</th>
                            <th>Foto 3</th>
                            <th>Foto 4</th>
                            <th>Foto 5</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paket_wisata as $key => $p)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$p->nama_paket}}</td>
                            <td>{{$p->deskripsi}}</td>
                            <td>{{$p->fasilitas}}</td>
                            <td>{{number_format($p->harga_per_pack)}}</td>
                            <td>{{$p->diskon}}%</td>
                            <td>
                            <img src="storage/{{$p->foto1}}"alt="{{$p->foto1}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$p->foto2}}"alt="{{$p->foto2}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$p->foto3}}"alt="{{$p->foto3}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$p->foto4}}"alt="{{$p->foto4}}" class="img-thumbnail"></td>
                            <td>
                            <img src="storage/{{$p->foto5}}"alt="{{$p->foto5}}" class="img-thumbnail"></td>
                            <td>
                                <a href="{{route('paketwisata.edit', $p)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('paketwisata.destroy', $p)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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