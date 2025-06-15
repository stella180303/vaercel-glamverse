<div class="header">
    <div class="container">
       <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
             <div class="full">
                <div class="center-desk">
                   <div class="logo">
                      <a href="{{ route('home') }}"><img src="pictures/logo4.png" alt="#" /></a>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
             <nav class="navigation navbar navbar-expand-md navbar-dark ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample04">
                   <ul class="navbar-nav mr-auto">
                      <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('home') }}">Home</a>
                      </li>
                      <li class="nav-item {{ Request::is('daftarsalon') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('daftarsalon') }}">List Salon</a>
                      </li>
                     
                      <li class="nav-item {{ Request::is('berita') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('berita') }}">Berita</a>
                      </li>
                      
                      <li class="nav-item">
                         <a class="nav-link" href="contact.html">Kontak kami</a>
                      </li>
                      
                     <li class="nav-item {{ Request::is('history') ? 'active' : '' }}">
                         <a class="nav-link" href="{{route('history')}}">History</a>
                      </li>
                     @auth
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 {{ Auth::user()->name }}
                           </a>
                           <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                                 <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                 </form>
                           </div>
                        </li>
                     @else
                        <li class="nav-item">
                           <a class="btn login" href="{{url('login')}}">Login</a>
                        </li>
                        @if (Route::has('register'))
                           <li class="nav-item">
                                 <a class="btn register" href="{{url('register')}}">Register</a>
                           </li>
                        @endif
                     @endauth

                   </ul>
                </div>
             </nav>
          </div>
       </div>
    </div>
 </div>