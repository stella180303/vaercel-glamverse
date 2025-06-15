<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil Salon</title>
    @include('ownersalon.css')
    <style>
        label{
            display: inline-block;
            width: 200px;
            padding: 20px;
        }

        .judul {
            font-size: 48px;
            font-weight: bold;
            padding: 20px;
        }
        
        .submit {
            margin: 20px;
        }

        .input {
            width: 30%;
        }
    </style>
</head>
<body>
    @include('ownersalon.header')
    
    @include('ownersalon.sidebar')

    @if(session('message'))
    <script>
        alert("{{ session('message') }}");
    </script>
    @endif

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <div>
                        <h1 class="judul">
                            Profil Salon
                        </h1>
                    </div>
                     <div>
                    {{--  'nama_salon',
                        'gambar',
                        'alamat',
                        'jam_buka',
                        'jam_tutup',
                        'hijab_room',
                        'produk',
                        'aksesibilitas',
                        'pembayaran',
                        'makanan_dan_minuman' --}}
                    <form action="{{url('tambah_profil')}}" method="Post" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div>
                            <label>Nama Salon</label>
                            <input type="text" name="nama_salon" class="input">
                        </div>

                        <div>
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="input">
                        </div>

                        <div>
                            <label>Alamat</label>
                            <textarea name="alamat" id="" cols="53" rows="5"></textarea>
                        </div>

                        <div>
                            <label>Jam Buka</label>
                            <input type="time" name="jam_buka" class="input">
                        </div>

                        <div>
                            <label>Jam Tutup</label>
                            <input type="time" name="jam_tutup" class="input">
                        </div>

                        <div>
                            <label>Ruang Hijab </label>
                            <select name="hijab_room" id="" class="input">
                                <option value="yes">Ya</option>
                                <option value="no">Tidak</option>
                            </select>
                        </div>

                        <div>
                            <label>Produk</label>
                            <input type="text" name="produk" class="input">
                        </div>

                        <div>
                            <label>Aksesibilitas</label>
                            <input type="text" name="aksesibilitas" class="input">
                        </div>

                        <div>
                            <label>Pembayaran</label>
                            <input type="text" name="pembayaran" class="input">
                        </div>

                        <div>
                            <label>Makanan dan minuman</label>
                            <input type="text" name="makanan_dan_minuman" class="input">
                        </div>

                        <div>
                            <input class="btn btn-primary submit" type="submit" value="Simpan" href="">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @include('ownersalon.footer')
</body>
</html>