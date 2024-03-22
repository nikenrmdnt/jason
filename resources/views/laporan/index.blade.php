@extends('adminlte::page')
@section('title', 'Laporan')
@section('content_header')
    <h1 class="m-0 text-dark">Laporan Reservasi</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card overflow-scroll">
                <div class="card-body">
                    <a href="{{ url('generateLaporan') }}" target="_blank" class="btn btn-primary mb-2">
                        Buat PDF
                    </a>
                    <div class="card-body ">
                        <form method="get" action="{{ route('search') }}" class="form-inline">
                            <div class="form-group mb-2">
                                <label for="start" class="">Tanggal Mulai:</label>
                                <input type="date" class="form-control" id="start" name="start"
                                    placeholder="Tanggal Mulai" value="{{ old('start') }}">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="end" class="">Tanggal Selesai:</label>
                                <input type="date" class="form-control" id="end" name="end"
                                    placeholder="Tanggal Selesai" value="{{ old('end') }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="status" class="">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pesan">Pesan</option>
                                    <option value="dibayar">Dibayar</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        </form>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
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
