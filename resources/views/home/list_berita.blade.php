<!DOCTYPE html>
<html lang="en">
<base href="/public">
<head>
    @include('home.css')
</head>

<body class="main-layout">
    <!-- load screen -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>

    <header>
        @include('home.header')
    </header>

    <div class="our_room" style="background: #f4f5f7;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage text-center">
                        <h2>Berita Terbaru</h2>
                        <p>
                            Dapatkan informasi, tips, dan update seputar kecantikan, perawatan diri, serta berita menarik dari dunia salon dan gaya hidup hanya di GlamVerse.
                        </p>
                    </div>
                </div>
            </div>

            {{-- List Berita --}}
            <div class="row" style="margin-top: 100px;" >
                @foreach ($berita as $item)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div id="serv_hover" class="salon listsalon">
                            <div class="salon_img">
                                <figure><img src="/gambar_berita/{{ $item->gambar }}" alt="#" style="height:200px; object-fit:cover;" /></figure>
                            </div>
                            <div class="salonlist">
                                <h3 class="nama_salon" style="line-height: 1.5;">{{ $item->judul }}</h3>
                                <p><i class="fa fa-user iconsalon" aria-hidden="true"></i> {{ $item->author }}</p>
                                <p><i class="fa fa-calendar iconsalon" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                                <p style="font-size: 14px;">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                                <a href="{{ route('berita.detail', $item->id) }}" class="detail">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $berita->links() }}
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
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
