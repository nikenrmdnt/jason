@extends('adminlte::page')
@section('title', 'List karyawan')
@section('content_header')
<h1 class="m-0 text-dark">List karyawan</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('karyawan.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>
                <table class="table table-hover table-bordered
table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id karyawan</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawan as $key => $k)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$k->id}}</td>
                            <td id={{$key+1}}>{{$k->nama_karyawan}}</td>
                            <td id={{$key+1}}>{{$k->alamat}}</td>
                            <td id={{$key+1}}>{{$k->no_hp}}</td>
                            <td>
                                @switch($k->jabatan)
                                    @case ('bendahara')
                                        Bendahara
                                        @break
                                    @case ('pemilik')
                                        Pemilik
                                        @break
                                    @default
                                        Admin
                                @endswitch
                            </td>
                            <td id={{$key+1}}>{{$k->karyawan->email}}</td>
                            <td>
                                <a href="{{route('karyawan.edit', $k)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('karyawan.destroy', $k)}}"
                                    onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                    class="btn btn-danger btn-xs">
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
    if (confirm('Apakah anda yakin akan menghapus data karyawan? \"' + document.getElementById(dt).innerHTML +
        '\" ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
}
</script>
@endpush