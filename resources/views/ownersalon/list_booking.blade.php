<!DOCTYPE html>
<html lang="en">
<head>
    @include('ownersalon.css')
    <title>List Booking</title>
    
    <style>
        .tabel {
            border: 2px solid #9D406D;
            margin: auto;
            margin-top: 20px;
            padding: 20px;
            width: 95%;
        }

        th {
            background: #9D406D;
            padding: 15px;
            color: white;
            text-align: center;
        }

        td {
            padding: 10px;
            vertical-align: middle;
        }

        tr {
            border: 1px solid #9D406D;
        }
    </style>
</head>
<body>
    @include('ownersalon.header')
        @include('ownersalon.sidebar')
       <div class="page-content">
            <div class="container-fluid">
                <h2 class="mt-4 mb-4">Daftar Reservasi Masuk</h2>
                <table class="tabel table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Status Layanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->nama }}</td>
                                <td>{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                                <td>{{ $booking->tanggal }}</td>
                                <td>{{ $booking->jam }}</td>
                                <td>{{ $booking->metode_pembayaran }}</td>
                                <td>{{ $booking->transaction_id ? '✅ Berhasil' : '❌ Gagal' }}</td>
                                <td>{{ ucfirst($booking->status_layanan ?? 'pending') }}</td>
                                <td>
                                    @if($booking->status_layanan === 'dibatalkan')
                                        <span class="text-danger">Dibatalkan</span>
                                    @elseif($booking->status_layanan === 'selesai')
                                        <span class="text-success">Selesai</span>
                                    @else
                                        <button onclick="showModalBatal({{ $booking->id }})" class="btn btn-danger btn-sm">❌ Batalkan</button>
                                        <a href="{{ url('/ownersalon/selesai_reservasi/'.$booking->id) }}"
                                            onclick="return confirm('Tandai reservasi ini sudah selesai?')"
                                            class="btn btn-success btn-sm mt-1">✅ Tandai Selesai</a>
                                    @endif

                                </td>
                            </tr>
                        
                        @empty
                            <tr><td colspan="8" class="text-center">Belum ada reservasi</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- Modal Pembatalan -->
            <div class="modal fade" id="modalBatal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="" id="formBatal">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Alasan Pembatalan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                        <textarea name="alasan" class="form-control" rows="4" required placeholder="Tuliskan alasan pembatalan..."></textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Kirim</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            
        </div>
    @include('ownersalon.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showModalBatal(id) {
            const form = document.getElementById('formBatal');
            form.action = `/ownersalon/batal_reservasi/${id}`;
            $('#modalBatal').modal('show');
        }
    </script>
</body>
</html>
