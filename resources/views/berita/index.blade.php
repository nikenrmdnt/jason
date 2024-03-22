@extends('adminlte::page')
@section('title', 'Berita')
@section('content_header')
    <h1 class="m-0 text-dark">Berita</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card overflow-scroll">
                <div class="card-body">
                    <a href="{{ route('berita.create') }}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Berita</th>
                                <th>Tanggal Post</th>
                                <th>Kategori Berita</th>
                                <th>Foto</th>
                                <th>Opsi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $key => $bs)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bs->judul}}</td>
                                    <td>{{ $bs->berita}}</td>
                                    <td>{{ $bs->tgl_post}}</td>
                                    <td id={{$key+1}}>{{ $bs->aberita->kategori_berita}}</td>
                                    <td>
                                        <img src="storage/{{$bs->foto}}" alt="{{$bs->foto}} tidak tampil" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="{{ route('berita.edit', $bs) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>
                                        <a href="{{ route('berita.destroy', $bs) }}"
                                            onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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

        function notificationBeforeDelete(event, el, dt) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }
    </script>
@endpush
