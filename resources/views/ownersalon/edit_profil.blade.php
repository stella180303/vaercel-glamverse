<!DOCTYPE html>
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
                    <form action="{{url('update_profil', $data->id)}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Nama Salon</label>
                            <input type="text" name="nama_salon" class="input" value="{{$data->nama_salon}}">
                        </div>

                        <div>
                            <label>Gambar yang sudah terunggah</label>
                            <img src="/profil/{{$data->gambar}}" alt="" class="img">
                        </div>
                        <div>
                            <label>Unggah gambar terbaru</label>
                            <input type="file" name="gambar" class="input">
                        </div>

                        <div>
                            <label>Alamat</label>
                            <textarea name="alamat" id="" cols="53" rows="5">{{$data->alamat}}</textarea>
                        </div>

                        <div>
                            <label>Jam Buka</label>
                            <input type="time" name="jam_buka" class="input" value="{{$data->jam_buka}}">
                        </div>

                        <div>
                            <label>Jam Tutup</label>
                            <input type="time" name="jam_tutup" class="input" value="{{$data->jam_tutup}}">
                        </div>

                        <div>
                            <label>Ruang Hijab </label>
                            <select name="hijab_room" id="" class="input">
                                <option value="{{$data->hijab_room}}">{{$data->hijab_room}}</option>
                                <option value="yes">Ya</option>
                                <option value="no">Tidak</option>
                            </select>
                        </div>

                        <div>
                            <label>Produk</label>
                            <input type="text" name="produk" class="input" value="{{$data->produk}}">
                        </div>

                        <div>
                            <label>Aksesibilitas</label>
                            <input type="text" name="aksesibilitas" class="input" value="{{$data->aksesibilitas}}">
                        </div>

                        <div>
                            <label>Pembayaran</label>
                            <input type="text" name="pembayaran" class="input" value="{{$data->pembayaran}}">
                        </div>

                        <div>
                            <label>Makanan dan minuman</label>
                            <input type="text" name="makanan_dan_minuman" class="input" value="{{$data->makanan_dan_minuman}}">
                        </div>

                        <div>
                            <input class="btn btn-primary submit" type="submit" value="Edit Profil" href="">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @include('ownersalon.footer')
</body>
</html>