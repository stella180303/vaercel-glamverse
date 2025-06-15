<!DOCTYPE html>
<html lang="en">
    <base href="/public">
   <head>
    @include('home.css')
   </head>
   <body class="main-layout">   
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <header>
        @include('home.header')
    </header>

    {{-- content --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            
            <div class="col-md-10">
                <a href="{{ route('home') }}" class="btn btn-warning mt-3 mb-2">Kembali</a>
                <h1 class="mb-2">{{ $berita->judul }}</h1>
                <p class="text-muted mb-2">
                    {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }} - {{ $berita->author }}
                </p>
                <img src="{{ asset('gambar_berita/' . $berita->gambar) }}" alt="gambar berita" class="img-fluid mb-4" />
                <div style="text-align: justify; text-justify: inter-word">
                    {!! $berita->deskripsi !!}
                </div>
                @if ($berita->link)
                <p class="mt-4">
                    Sumber: <a href="{{ $berita->link }}" target="_blank">{{ $berita->link }}</a>
                </p>
                @endif
            </div>
        </div>
    </div>
      {{-- end content --}}
      <footer>
        @include('home.footer')
      </footer>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>