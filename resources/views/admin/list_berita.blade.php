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
            vertical-align: top;
        }

        tr {
            border: 1px solid #9D406D;
        }

        img {
            width: 100px;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h2 class="mt-4 mb-4">Daftar Berita</h2>
             <a href="{{ url('/tambah_berita') }}" class="btn btn-primary">➕ Tambah Berita</a>
            <table class="tabel table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Author</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $berita)
                        <tr>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->author }}</td>
                            <td><img src="/gambar_berita/{{ $berita->gambar }}" alt="Gambar Berita"></td>
                            <td>{{ $berita->deskripsi }}</td>
                            <td>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</td>
                            <td>
                                @if($berita->link)
                                    <a href="{{ $berita->link }}" target="_blank">Lihat</a>
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/edit_berita', $berita->id) }}" class="btn btn-info" style="width: 100%;">Edit</a>
                                <div style="margin:10px;"></div>
                                <a href="{{ url('/hapus_berita', $berita->id) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada berita</td>
                            
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
