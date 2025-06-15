<!DOCTYPE html>
<html lang="en">
   <base href="/public">
   <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      @include('home.css')
   </head>
      
   
   <!-- body -->
   <body class="main-layout">
      <!-- load screen  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- load screen -->
      
      <header>
        @include('home.header')
      </header>
      
      <div class="container" style="margin-top: 100px; margin-bottom: 200px;">
        <h1 class="nama_salon">Riwayat Reservasi Anda</h1>
            <table class="table table-hover">
                <tr>
                    <th>Nama</th>
                    <th>Nama Salon</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Metode</th>
                    <th>Status Pembayaran</th>
                    <th>Status Layanan</th>
                    <th>Aksi</th>
                </tr>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->nama ?? '-' }}</td>
                        <td>{{ $booking->layanan->profil_salon->nama_salon ?? '-' }}</td>
                        <td>{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                        <td>{{ $booking->tanggal }}</td>
                        <td>{{ $booking->jam }}</td>
                        <td>{{ $booking->metode_pembayaran }}</td>
                        <td>{{ $booking->transaction_id ? 'Berhasil' : 'Pending' }}</td>
                        <td>
                            @if ($booking->status_pembatalan === 'ditolak')
                                <span class="text-danger">Pembatalan Ditolak</span>
                            @else
                                {{ ucfirst($booking->status_layanan ?? 'pending') }}
                            @endif
                        </td>
                        <td>
                            @if ($booking->status_pembatalan === 'menunggu')
                                <span class="text-warning">Menunggu Persetujuan</span>
                            @elseif ($booking->status_pembatalan === 'disetujui')
                                <span class="text-danger">Dibatalkan</span>
                            @elseif ($booking->status_pembatalan === 'ditolak')
                                <span class="text-danger">Pembatalan Ditolak</span>
                            @elseif ($booking->status_layanan !== 'dibatalkan')
                                <!-- Button ajukan pembatalan -->
                                <button class="btn btn-danger btn-sm" onclick="showModalBatal({{ $booking->id }})">
                                    Ajukan Batal
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Belum ada reservasi.</td></tr>
                @endforelse
            </table>
            <nav class="mt-4 d-flex justify-content-center">
                {{ $bookings->links('pagination::bootstrap-4') }}
            </nav>
            <!-- Modal Pembatalan -->
            <div class="modal fade" id="modalBatal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="" id="formBatal">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ajukan Pembatalan</h5>
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
        
        <footer>
            @include('home.footer')
        </footer>

        <script>
            function showModalBatal(bookingId) {
                const form = document.getElementById('formBatal');
                form.action = `/home/batal_booking/${bookingId}`;
                $('#modalBatal').modal('show');
            }
        </script>
    
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>