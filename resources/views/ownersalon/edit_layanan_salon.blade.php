_<!DOCTYPE html>
<html lang="en">
    <base href="/public">
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

        .img   {
            margin-top: 0%;
            margin-left: 200px;
        }
    </style>
</head>

<body>
    @include('ownersalon.header')
        @include('ownersalon.sidebar')

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <div>
                        <h1 class="judul">
                           Edit Profil Salon
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
                    <form action="{{url('update_layanan', $layanan->id)}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="input" value="{{$layanan->nama_layanan}}" required>
                        </div>
                        <div>
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi_layanan" class="input" value="{{$layanan->deskripsi_layanan}}" required>
                        </div>

                        <div>
                            <label>Harga</label>
                            <input type="text" name="harga" value="{{$layanan->harga}}" class="input" ></input>
                        </div>

                        <div>
                            <label>Gambar yang sudah terunggah</label>
                            <img src="/layanan/{{$layanan->gambar}}" alt="" class="img">
                        </div>

                        <div>
                            <input class="btn btn-primary submit" type="submit" value="Edit Layanan" href="">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @include('ownersalon.footer')
</body>
</html>