<!DOCTYPE html>
<html>
{{-- Halaman Owner Salon --}}
    {{-- css --}}
  <head> 
    @include('ownersalon.css')
    <style>
        .tabel {
            border: 2px solid #9D406D;
            margin: auto;
            margin-top: 20px;
            padding: 20px;
        }
  
        th {
            background: #9D406D;
            padding: 15px;
            color: white
        }
  
        td{
            padding: 10px;  
        }
  
        tr {
            border: 1px solid #9D406D;  
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
  </head>
    {{-- end css --}}
  <body>
    {{-- header --}}
        @include('ownersalon.header')
    {{-- end header --}}
    
    <!-- Sidebar Navigation-->
    @include('ownersalon.sidebar')
    <!-- Sidebar Navigation end-->
      
    {{-- content --}}
    @if(session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                
                <h1>
                    Daftar Layanan Salon
                </h1>
                <table class="tabel">
                    <tr>
                        <th>Nama Layanan</th>
                        <th>Deskripsi Layanan</th>
                        <th>Harga (Dalam Rupiah)</th>
                        <th>Gambar</th>
                        <th>Hari Tersedia</th>
                        <th>Jam Tersedia</th>  
                        <th colspan="2">Aksi</th>
                    </tr>

                    @foreach($data_layanan as $data) 
                    <tr>
                        <td>{{$data->nama_layanan}}</td>
                        <td>{{$data->deskripsi_layanan}}</td>
                        <td>{{$data->harga}}</td>
                        <td><img src="/layanan/{{$data->gambar}}" alt=""></td>
                        <td>
                            @if ($data->hari_tersedia)
                                @foreach (json_decode($data->hari_tersedia) as $hari)
                                    <span class="badge">{{ $hari }}</span><br>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->jam_tersedia)
                                @foreach (json_decode($data->jam_tersedia) as $jam)
                                    <span class="badge">{{ $jam }}</span><br>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="/edit_layanan/{{ $data->id }}">Update</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"   class="btn btn-danger" href="/hapus_layanan/{{ $data->id }}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>    
    {{-- end content --}}
        
    @include('ownersalon.footer')
  </body>
</html>