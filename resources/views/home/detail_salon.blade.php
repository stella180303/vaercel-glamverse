<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.css')
      
   </head>
   

   <style>
    .bannerimg {
        max-height: 400px;
        border-radius: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .layananimg {
        max-width: 100px;
        max-height: 50px;
        border-radius: 10px;
    }

    .nama_salon {
        font-weight: bold; 
        font-size: 40px; 
        margin-top:40px;
        margin-bottom: 10px;
        color: black;
    }
   </style>
      
   
   <!-- body -->
   <body class="main-layout">
      <!-- load screen  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- load screen -->
      <!-- header -->
      <header>
         <!-- header inner -->
         @include('home.header')
      </header>
      <!-- end header inner -->
      <!-- end header -->

      {{-- content --}}
      <div class="container">
         <container>
            <div >
                <p class="nama_salon">{{$profil_salon->nama_salon}}</p>
            </div>
            <div >
                <figure><img src="/profil/{{$profil_salon->gambar}}" alt="#" class="bannerimg"/></figure>
             </div>
             <div>
                <p>
                    <i class="fa fa-map-marker iconsalon" aria-hidden="true"></i>          {{$profil_salon->alamat}}
                </p>
             </div>
             <div>
                <p>
                    <i class="fa fa-clock-o iconsalon" aria-hidden="true"></i> Jam Buka   : {{$profil_salon->jam_buka}} - {{$profil_salon->jam_tutup}}
                 </p> 
             </div>
             <div>
                <p>
                    <i class="fa fa-user iconsalon" aria-hidden="true"></i> Hijab Room : @if($profil_salon->hijab_room == 'yes')
                    <b>Tersedia</b>
                    @else
                        <span style="color: red;"><b>Tidak Tersedia</b></span>
                    @endif
                 </p>
             </div>

            <div class="kelengkapan">
              <div>
                <p class="judul_kelengkapan">
                    <i class="fa fa-user iconsalon" aria-hidden="true"></i> Kelengkapan
                </p>
              </div>

               <div class="listkelengkapan">
                  <div class="row">
                    <div class="col-md-4">
                        <label for="">Produk</label>
                    </div>
                    <div class="col-md-8">
                        <p>
                            {{$profil_salon->produk}}
                        </p>
                    </div>
                  </div>
                  <div>
                    <hr style="border: 1pxx rgb(59, 59, 59); margin-bottom:5px;">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label for="">Aksesibilitas</label>
                    </div>
                    <div class="col-md-8">
                        <p>
                            {{$profil_salon->aksesibilitas}}
                        </p>
                    </div>
                  </div>
                  <div>
                    <hr style="border: 1pxx rgb(59, 59, 59); margin-bottom:5px;">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label for="">Pembayaran</label>
                    </div>
                    <div class="col-md-8">
                        <p>
                            {{$profil_salon->pembayaran}}
                        </p>
                    </div>
                  </div>
                  <div>
                    <hr style="border: 1pxx rgb(59, 59, 59); margin-bottom:5px;">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label for="">Makanan dan Minuman</label>
                    </div>
                    <div class="col-md-8">
                        <p>
                            {{$profil_salon->makanan_dan_minuman}}
                        </p>
                    </div>
                  </div>
                  <div>
                    <hr style="border: 1pxx rgb(59, 59, 59); margin-bottom:5px;">
                  </div>
                 </p>
               </div>
            </div>

            <div>
                <div class="judul_kelengkapan">
                    <i class="fa fa-list iconsalon" aria-hidden="true"></i> Layanan
                </div>
                <div class="row">
                @forelse($profil_salon->layanan as $layanan)
               
                    <div class="col-4 layanan">
                         <a href=" {{ url('layanan/' . $layanan->id) }}">
                        <figure><img src="/layanan/{{$layanan->gambar}}" alt="#" class="layananimg"/></figure>
                        <p class="judul_layanan">
                            {{$layanan->nama_layanan}}
                        </p>
                        <p>
                            Harga : mulai dari Rp.{{$layanan->harga}}
                        </p>
                         </a>
                    </div>
               
                @empty
                    <p class="text-muted">Belum ada layanan tersedia.</p>
                @endforelse
            </div>
            </div>
         </container>
      </div>
      {{-- End Content --}}

      <!--  footer -->
      <footer>
         @include('home.footer')
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>