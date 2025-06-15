<div class="our_room" style=" background-color: #f4f5f7; margin-top: 100px; height: 100%; padding-top: 100px;">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <h2>Partner Kami</h2>
                <p>Glameverse hadir sebagai platform yang menghubungkan kamu dengan berbagai salon pilihan di sekitarmu. Kami menyediakan cara mudah dan cepat untuk menemukan, membandingkan, dan memesan layanan kecantikan secara online—kapan pun kamu butuh, tanpa perlu antre atau ribet. Cukup beberapa klik, dan reservasi impianmu sudah di tangan!</p>
             </div>
          </div>
       </div>

      
      <div class="row">
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
       

    </div>
 </div>