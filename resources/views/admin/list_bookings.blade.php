<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
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
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h2 class="mt-4 mb-4">Daftar Reservasi</h2>
            <table class="tabel table-bordered">
                <thead>
                    <tr>
                        <th>Nama Salon</th>
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
                            <td>{{ $booking->salon->nama_salon ?? '-' }}</td>
                            <td>{{ $booking->nama}}</td>
                            <td>{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                            <td>{{ $booking->tanggal }}</td>
                            <td>{{ $booking->jam }}</td>
                            <td>{{ $booking->metode_pembayaran }}</td>
                            <td>{{ $booking->transaction_id ? '✅ Berhasil' : '❌ Gagal' }}</td>
                            <td>{{ ucfirst($booking->status_layanan ?? 'pending') }}</td>
                            <td>
                                @if($booking->status_layanan === 'dibatalkan')
                                    <span class="text-danger">Dibatalkan</span>
                                @else
                                    <a href="{{ url('/admin/batal_reservasi/'.$booking->id) }}" class="btn btn-danger btn-sm">❌ Batalkan</a>
                                    <a href="{{ url('/admin/selesai_reservasi/'.$booking->id) }}" class="btn btn-success btn-sm mt-1">✅ Tandai Selesai</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">Belum ada reservasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
