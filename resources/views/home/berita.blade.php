<div class="blog">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Info dan Inspirasi</h2>
               <p>Jelajahi artikel terbaru tentang perawatan, makeover, dan rekomendasi produk untuk tampilan sempurna.</p>
            </div>
         </div>
      </div>
      <div class="row">
         @forelse ($berita as $item)
            <div class="col-md-4 mb-4">
               <div class="blog_box">
                  <div class="blog_img">
                     <figure>
                        <img src="{{ asset('gambar_berita/' . $item->gambar) }}" alt="gambar berita"/>
                     </figure>
                  </div>
                  <div class="blog_room">
                     <h3>{{ $item->judul }}</h3>
                     <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} - {{ $item->author }}</span>
                     <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 120, '...') }}</p>
                     @if ($item->link)
                        <a href="{{ route('berita.detail', $item->id) }}">Baca Selengkapnya</a>
                     @endif
                  </div>
               </div>
            </div>
         @empty
            <div class="col-md-12 text-center">
               <p>Belum ada berita yang tersedia.</p>
            </div>
         @endforelse
      </div>
   </div>
</div>
