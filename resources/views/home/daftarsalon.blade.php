<!DOCTYPE html>
<html lang="en">
   <base href="/public">
   <head>
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
      
    <div class="our_room " style=" background-color: #f4f5f7; margin-top: 100px; height: 100%; padding-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage text-center">
                        <h2>Cari Salon Terdekat</h2>
                        <p>
                            Glameverse hadir sebagai platform yang menghubungkan kamu dengan berbagai salon pilihan di sekitarmu. Kami menyediakan cara mudah dan cepat untuk menemukan, membandingkan, dan memesan layanan kecantikan secara online—kapan pun kamu butuh, tanpa perlu antre atau ribet. Cukup beberapa klik, dan reservasi impianmu sudah di tangan!
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form pencarian --}}
            <div class="row mb-4">
                <div class="col-md-3"><input type="text" class="form-control" placeholder="Cari Salon"></div>
                <div class="col-md-3"><input type="text" class="form-control" placeholder="Lokasi"></div>
                <div class="col-md-3"><input type="date" class="form-control"></div>
                <div class="col-md-3"><button class="btn w-100" style="background-color: #9D406D; color: white;">Cari</button></div>
            </div>

            {{-- List salon --}}
             <div class="row" style="margin-top:100px;">
                @foreach ($profil_salon as $salon)
                <div class="col-md-4 col-sm-6 ">
                    <div id="serv_hover"  class="salon listsalon">
                        <div class="salon_img">
                        <figure><img src="/profil/{{$salon->gambar}}" alt="#"/></figure>
                        </div>
                        <div class="salonlist">
                        <h3 class="nama_salon" style="line-height: 1.5;">{{$salon->nama_salon}}</h3>
                        <p><i class="fa fa-map-marker iconsalon" aria-hidden="true"></i>       {{$salon->alamat}}
                        </p>
                        <p>
                            <i class="fa fa-clock-o iconsalon" aria-hidden="true"></i> Jam Buka   : {{$salon->jam_buka}} - {{$salon->jam_tutup}}
                        </p> 
                        <p>
                            <i class="fa fa-user iconsalon" aria-hidden="true"></i> Hijab Room : {{$salon->hijab_room}}
                        </p>
                        <p><i class="fa fa-list iconsalon" aria-hidden="true"></i>
                                Layanan : 
                                @forelse($salon->layanan as $layanan)
                                {{ $layanan->nama_layanan }},
                                @empty
                                <li>Belum ada layanan</li>
                                @endforelse
                        </p>
                        <a href="{{url('detail_salon/'.$salon->id)}}" class="detail ">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach   
                
            </div>

            {{-- Pagination (jika ada) --}}
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $profil_salon->links() }} {{-- pastikan data $profil_salon berupa paginated result --}}
                </div>
            </div>
        </div>
</div>

      <footer>
         @include('home.footer')
      </footer>
    
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>