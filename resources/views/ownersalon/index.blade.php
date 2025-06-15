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
  </style>
  </head>
    {{-- end css --}}
  <body>
    @include('ownersalon.header')
    @include('ownersalon.sidebar')

    <div class="page-content">
      <div class="page-header">
          <div class="container-fluid">

              <table class="tabel">

                <tr>
                  <th>Nama Salon</th>
                  <th>Gambar</th>
                  <th>Alamat</th>
                  <th>Jam Buka</th>
                  <th>Jam Tutup</th>
                  <th>Ruang Hijab</th>
                  <th>Produk</th>
                  <th>Aksesibilitas</th>
                  <th>Pembayaran</th>
                  <th>Makanan dan minuman</th>
                  <th colspan="2">Aksi</th>
              </tr>

                  @foreach($data as $data) 
                  <tr>
                      <td>{{$data->nama_salon}}</td>
                      <td><img src="/profil/{{$data->gambar}}" alt=""></td>
                      <td>{{$data->alamat}}</td>
                      <td>{{$data->jam_buka}}</td>
                      <td>{{$data->jam_tutup}}</td>
                      <td>{{$data->hijab_room}}</td>
                      <td>{{$data->produk}}</td>
                      <td>{{$data->aksesibilitas}}</td>
                      <td>{{$data->pembayaran}}</td>
                      <td>{{$data->makanan_dan_minuman}}</td>
                      <td>
                          <a class="btn btn-info" href="{{url('edit_profil', $data->id)}}">Edit Profil</a>
                      </td>
                      <td>
                          <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"   class="btn btn-danger" href="{{url('hapus_profil', $data->id)}}">Hapus</a>
                      </td>
                      
                  </tr>
                  @endforeach
              </table>
          </div>
      </div>
  </div>    

    @include('ownersalon.footer')    
  </body>
</html>