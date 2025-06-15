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
            <div class="container mt-5">
                <h1 style="margin-bottom: 20px;">Permintaan Pembatalan Reservasi</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Alasan</th>
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
                            <td>{{ $booking->alasan_pembatalan ?? '-' }}</td>
                            <td>
                                <form method="POST" action="{{ url('/ownersalon/pembatalan/setujui/'.$booking->id) }}" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>
                                <form method="POST" action="{{ url('/ownersalon/pembatalan/tolak/'.$booking->id) }}" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center">Tidak ada permintaan pembatalan</td></tr>
                        @endforelse
                    </tbody>
                </table>
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
