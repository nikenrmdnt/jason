@extends('adminlte::page')
@section('title', 'Booking Reservasi')
@section('content_header')
<h1 class="m-0 text-dark">Booking Reservasi</h1>
@stop
@section('content')
<form action="{{route('reservasi.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                        <input type="hidden" class="form-control
@error('id_pelanggan') is-invalid @enderror" id="id_pelanggan" placeholder="Tanggal Pemesanan" name="id_pelanggan" value="{{ Auth::user()->pelanggan->id }}">
                        @error('id_pelanggan') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                        <div class="form-group">
                        <label for="id_paket">Nama Paket</label>
                        <div class="input-group">
                            <input type="hidden" name="id_paket" id="id_paket" value="{{old('id_paket')}}">
                            <input type="text" class="form-control
@error('paket_wisata') is-invalid @enderror" placeholder="Cari Paket Wisata" id="paket_wisata" name="paket_wisata" value="{{old('paket_wisata')}}" arialabel="paket_wisata" aria-describedby="cari1" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop1"></i>
                                Cari Paket Anda</button>
                        </div>

                    <div class="form-group">
                        <label for="tgl_reservasi_wisata">Tanggal Pemesanan</label>
                        <input type="datetime-local" class="form-control
@error('tgl_reservasi_wisata') is-invalid @enderror" id="tgl_reservasi_wisata" placeholder="Tanggal Pemesanan" name="tgl_reservasi_wisata" value="{{old('tgl_reservasi_wisata')}}">
                        @error('tgl_reservasi_wisata') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" placeholder="Jumlah Peserta" max='100' name="jumlah_peserta" value="{{old('jumlah_peserta')}}" onchange="hargadisk()">
                        @error('jumlah_peserta') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Harga"  name="harga" value="{{old('harga')}}" onchange = "hargadisk()">
                        @error('harga') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="diskon">Diskon Dalam Persenan</label>
                        <input type="number" class="form-control @error('diskon') is-invalid @enderror" id="diskon" placeholder="Diskon" max='100' name="diskon" value="{{old('diskon')}}" onchange = "hargadisk()">
                        @error('diskon') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_diskon">Nilai Diskon</label>
                        <input type="number" class="form-control @error('nilai_diskon') is-invalid @enderror" id="nilai_diskon" placeholder="Nilai Diskon"  name="nilai_diskon" value="{{old('nilai_diskon')}}" >
                        @error('nilai_diskon') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" class="form-control @error('total_bayar') is-invalid @enderror" id="total_bayar" placeholder="Total Bayar" name="total_bayar" value="{{old('total_bayar')}}" readonly >
                        @error('total_bayar') <span class="textdanger">{{$message}}</span> @enderror
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
</form>    

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Kategori Berita</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered tablestripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelanggan as $key => $a)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$a->nama_lengkap}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary
btn-xs" onclick="pilih('{{$a->id}}', '{{$a->nama_lengkap}}')" data-bs-dismiss="modal">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

         <!-- Modal -->
         <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Paket Wisata</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered tablestripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Paket Wisata</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paketwisata as $key => $a)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$a->nama_paket}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary
btn-xs" onclick="pilih1('{{$a->id}}', '{{$a->nama_paket}}')" data-bs-dismiss="modal">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->


        @stop
        @push('js')
        <script>
            $('#example2').DataTable({
                "responsive": true,
            });


            function pilih(id_pelanggan, pelanggan) {
                document.getElementById('id_pelanggan').value = id_pelanggan
                document.getElementById('pelanggan').value = pelanggan
            }

            function pilih1(id_paket, paket_wisata) {
                document.getElementById('id_paket').value = id_paket
                document.getElementById('paket_wisata').value = paket_wisata
            }
            
        </script>
        <script>
            function hargadisk(){
            var harga = document.getElementById('harga').value;
            var diskon = document.getElementById('diskon').value;
            var peserta = document.getElementById('jumlah_peserta').value;
            
            diskon_decimal = diskon/100;
            perhitungan_diskon = harga*diskon_decimal;
            harga_dis = harga-perhitungan_diskon;
            total = harga * peserta - perhitungan_diskon;
            document.getElementById('total_bayar').value= total;
            document.getElementById('nilai_diskon').value= perhitungan_diskon;
          }
        </script>
        @endpush