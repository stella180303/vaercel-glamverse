<div class="footer">
    <div class="container">
       <div class="row">
          <div class=" col-md-4">
             <h3>Contact US</h3>
             <ul class="conta">
                <li><i class="fa fa-map-marker" aria-hidden="true"></i>Jakarta</li>
                <li><i class="fa fa-mobile" aria-hidden="true"></i> +0561 2123221</li>
                <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> stella010@binus.ac.id</a></li>
             </ul>
          </div>
          <div class="col-md-4">
               <h3>Menu Link</h3>
                <ul class="link_menu">
                  <li class="{{ Request::is('home') ? 'active' : '' }}">
                     <a  href="{{ route('home') }}">Home</a>
                  </li>
                  <<li class=" {{ Request::is('daftarsalon') ? 'active' : '' }}">
                     <a href="{{ route('daftarsalon') }}">List Salon</a>
                  </li>
                  <li class="{{ Request::is('berita') ? 'active' : '' }}">
                     <a href="{{ route('berita') }}">Berita</a>
                  </li>
                  <li class="">
                     <a href="contact.html">Kontak kami</a>
                  </li>
                  <li class="{{ Request::is('history') ? 'active' : '' }}">
                     <a href="{{route('history')}}">History</a>
                  </li>
            @if (Route::has('createsalon'))
                <li class="nav-item">
                    <a class="btn register" href="{{url('createsalon')}}">Daftarkan salon anda disini!</a>
                </li>
            @endif
             </ul>
          </div>
          <div class="col-md-4">
             <h3>Langganan berita terbaru!</h3>
             <form class="bottom_form">
                <input class="enter" placeholder="Masukan email" type="text" name="Enter your email">
                <button class="sub_btn">Langganan</button>
             </form>
             <ul class="social_icon">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="copyright">
       <div class="container">
          <div class="row">
             <div class="col-md-10 offset-md-1">
                
                <p>
                © 2025 All Rights Reserved. Design by Stella</a>
                </p>

             </div>
          </div>
       </div>
    </div>
 </div>