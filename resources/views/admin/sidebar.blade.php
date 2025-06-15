<div class="d-flex align-items-stretch">
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="title">
        <h1 class="h5">{{Auth::user()->name}}</h1>
        <p>Super admin</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="active"><a href="{{ url('/home') }}"> <i class="icon-home"></i>Home </a></li>
            <li><a href="{{ route('admin.listSalon') }}"> <i class="icon-windows"></i> List Salon</a></li>
            <li><a href="{{ url('/listBerita') }}"> <i class="icon-list"></i> List Berita</a></li>
            <li><a href="{{ url('/admin/bookings') }}"> <i class="icon-list"></i> Pesanan Masuk</a></li>
            <li><a href="{{ url('/admin/pesan') }}"> <i class="icon-list"></i> Kotak Saran</a></li>
            <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
    </ul> 
  </nav>