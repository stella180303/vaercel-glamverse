    <!DOCTYPE html>
    <html lang="en">
    <head>
        <base href="/public">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @include('home.css')
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            .form-container {
                padding: 20px;
                max-width: 600px;
                margin: auto;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
            }

            .form-control  {
                border: 2px solid #c4c4c4  !important;
                border-radius: 5px !important;       
                min-height: 60px !important;
            }

            .form-control:focus {
                border-color: #9D406D  !important; 
                outline: none !important;        
            }

            .deskripsi_detail {
                text-align: justify;
                margin: 10px;
            }
            
            .icondetail {
                color: #EB9481;
            }

            .btn-submit {

                padding: 10px !important;
                background-color: #9D406D !important;
                color: white !important;
                border-radius: 5px !important;
                border: none    !important;
                style : none;
            }
            .btn-submit:hover {

                padding: 10px !important;
                background-color: #a71c5f !important;
                color: white !important;
                border-radius: 5px !important;
                border: none    !important;
                style : none;
            }
        </style>
    </head>
    <meta name="user-id" content="{{ auth()->id() }}">
    <body>
        @include('home.header')
        <div class="form-container">
            <p class="judul_form">Form Reservasi Layanan</p>    
            <div class="nama_layanan">
                <p class="judul_kelengkapan">
                    <i class="fa fa-list icondetail" aria-hidden="true"></i> Layanan yang dipilih
                </p>
                <figure><img src="/layanan/{{$layanan->gambar}}" alt="#" class="layanaimgdetail"/></figure>
                <p class="judul_layanan">{{ $layanan->nama_layanan }}</p>
            </div>

            <form class="form_isi" method="POST">
                @csrf
                <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <p for="nama">Nama Anda</p>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <p for="nomor_whatsapp">Nomor WhatsApp</p>
                            <input type="tel" name="nomor_whatsapp" class="form-control" required>
                            <span style="font-size: 10px; color: blue;">Wajib dengan format 62xxxx</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <p for="tanggal_pemesanan">Tanggal Pemesanan</p>
                            <input type="text" id="tanggal_pemesanan" name="tanggal_pemesanan" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <p for="jam_pemesanan">Jam</p>
                        <select name="jam_pemesanan" class="form-control" required>
                                <option disabled selected>Pilih Jam</option>
                                @foreach(json_decode($layanan->jam_tersedia) as $jam)
                                    <option value="{{ $jam }}">{{ $jam }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                

                <div class="nama_layanan">
                    <p class="judul_kelengkapan">
                        <i class="fa fa-credit-card icondetail" aria-hidden="true"></i> Pembayaran
                    </p>
                    <div class="deskripsi_detail">
                        <p>
                            Pembayaran ini merupakan Down Payment (DP) sebagai tanda jadi reservasi.
                            DP akan dipotong dari total biaya perawatan rambut saat pembayaran akhir.
                        </p>
                        <p>
                            <i>
                                Pembatalan bisa dilakukan maksimal 3 jam sebelum jam reservasi.Lewat dari itu, DP dianggap hangus.
                            </i>
                        </p>
                        <p>
                            <b>Pembayaran Awal : Rp. 50.000</b> 
                        </p>
                    </div>
                </div>
                <button class="btn btn-primary btn-submit mt-3" id="bayarSekarang">Pesan Sekarang</button>
            </form>
        </div>

        @include('home.footer')

        <script>
            const hariTersedia = {!! json_encode(json_decode($layanan->hari_tersedia) ?? []) !!};
            const convertHari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

            flatpickr("#tanggal_pemesanan", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    function(date) {
                        // Ambil nama hari dari date JS
                        const hari = convertHari[date.getDay()];
                        return !hariTersedia.includes(hari); // kalau bukan hari tersedia → disable
                    }
                ],
                locale: {
                    firstDayOfWeek: 1
                }
            });
        </script>

        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    document.getElementById('bayarSekarang').addEventListener('click', function (e) {
        e.preventDefault();
        const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');
        const layananId = document.querySelector('[name=layanan_id]').value;
        const nama = document.querySelector('[name=nama]').value;
        const nomor_whatsapp = document.querySelector('[name=nomor_whatsapp]').value;
        const tanggal = document.querySelector('[name=tanggal_pemesanan]').value;
        const jam = document.querySelector('[name=jam_pemesanan]').value;

        // Validasi
        if (!nama || !nomor_whatsapp || !tanggal || !jam) {
            alert("Harap lengkapi semua data.");
            return;
        }

        // Ambil Snap Token dari backend
        fetch('/snap/token', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nama: nama,
                nomor_whatsapp: nomor_whatsapp,
            })
        })
        .then(res => res.json())
        .then(res => {
            snap.pay(res.snapToken, {
                onSuccess: function(result) {
                    fetch('/snap/finish', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            user_id: document.querySelector('[name=user_id]').value,
                            layanan_id: layananId,
                            nama: nama,
                            nomor_whatsapp: nomor_whatsapp,
                            tanggal: tanggal,
                            jam: jam,
                            metode_pembayaran: result.payment_type,
                            transaction_id: result.transaction_id,
                            order_id: result.order_id,
                            gross_amount: result.gross_amount,
                            
                        })
                    }).then(() => {
                        window.location.href = "/history";
                    });
                },
                onClose: function() {
                    alert("Pembayaran dibatalkan.");
                },
                onError: function() {
                    alert("Terjadi kesalahan saat pembayaran.");
                }
            });
        })
        .catch(err => {
            console.error(err);
            alert("Gagal mengambil token pembayaran.");
        });
    });
</script>
    </body>
    </html>
