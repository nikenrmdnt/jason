                    <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    table th,
                    table td {
                        padding: 8px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }

                    table th {
                        background-color: #f2f2f2;
                    }

                    table tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }

                    table tr:hover {
                        background-color: #f5f5f5;
                    }
                    </style>
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