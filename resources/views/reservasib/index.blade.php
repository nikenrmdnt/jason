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
                    <a href="{{ route('reservasib.create') }}" class="btn btn-primary mb-2">
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
                            <th>Foto Bukti Pembayaran</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi as $key => $bs)
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
                                    @if ($bs->file_bukti_tf != null)
                                                    <a href="storage/{{$bs->file_bukti_tf}}"
                                                        class="btn btn-primary" target="_blank">Lihat Bukti</a>
                                                @else
                                                    Menunggu Pembayaran
                                                @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('reservasib.edit', $bs) }}" class="btn btn-primary btn-xs">
                                            Ubah Status
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
