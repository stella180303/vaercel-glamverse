<div class="d-flex align-items-stretch">
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
    
      <div class="title">
        <h1 class="h5">{{Auth::user()->name}}</h1>
        <p>Owner Salon</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
                <li class="active"><a href="{{ route('ownersalon.homepage') }}"> <i class="icon-home"></i>Home </a>
                </li>
                <li class="{{ Request::is('profil_salon') ? 'active' : '' }}">
                    <a href="{{ url('profil_salon') }}"><i class="icon-user"></i>Profil Salon</a>
                </li>
                <li class="{{ Request::is('tambah_layanan_salon') ? 'active' : '' }}">
                    <a href="{{ url('tambah_layanan_salon') }}"><i class="icon-list"></i>Layanan Salon</a>
                </li>
                <li class="{{ Request::is('view_layanan_salon') ? 'active' : '' }}">
                    <a href="{{ url('view_layanan_salon') }}"><i class="icon-list"></i>View Layanan Salon</a>
                </li>
                <li class="{{ Request::is('ownersalon/bookings') ? 'active' : '' }}">
                    <a href="{{ route('ownersalon.bookings') }}">
                        <i class="icon-list"></i>Reservasi Masuk
                    </a>
                </li>
                <li><a href="{{ route('ownersalon.pembatalan') }}"><i class="icon-list"></i>Pembatalan Masuk</a></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 20px;">
                  @csrf
                  <button type="submit" class="btn btn-link text-left" style="color: #fff; padding-left: 0;">
                      <i class="icon-logout"></i> Logout
                  </button>
              </form>
            </li>
    </ul> 
  </nav>