@extends('adminlte::page')
@section('title', 'Reservasi')
@section('content_header')
    <h1 class="m-0 text-dark">Reservasi</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card overflow-scroll">
                <div class="card-body">
                    <a href="{{ route('reservasi.create') }}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered
table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Paket</th>
                            <th>Tanggal Reservasi</th>
                            <th>Harga</th>
                            <th>Jumlah Peserta</th>
                            <th>Diskon</th>
                            <th>Nilai Diskon</th>
                            <th>Total Bayar</th>
                            <th>Status Reservasi</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $bs)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td id={{$key+1}}>{{ $bs->pelanggan->nama_lengkap}}</td>
                                    <td id={{$key+1}}>{{ $bs->paketwisata->nama_paket}}</td>
                                    <td>{{ $bs->tgl_reservasi_wisata}}</td>
                                    <td>{{ $bs->harga}}</td>
                                    <td>{{ $bs->jumlah_peserta}}</td>
                                    <td>{{ $bs->diskon}}</td>
                                    <td>{{ $bs->nilai_diskon}}</td>
                                    <td>{{ $bs->total_bayar}}</td>
                                    <td>{{ $bs->status_reservasi_wisata}}</td>
                                    <td>
                                        <a href="{{ route('reservasi.edit', $bs) }}" class="btn btn-primary btn-xs">
                                            Bayar
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

    </script>
@endpush
