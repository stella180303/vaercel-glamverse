<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layanan Salon</title>
    @include('admin.css')
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

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <div>
                        <h1 class="judul">
                            Layanan Salon
                        </h1>
                    </div>
                     <div>
                    {{--   'nama_layanan',
    //                   'deskripsi_layanan',
    //                  'harga',
                        'gambar'
                    --}}
                    <form action="{{url('tambah_layanan')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="input">
                        </div>

                        <div>
                            <label>Deskripsi Layanan</label>
                            <textarea name="deskripsi_layanan" cols="53" rows="5"></textarea>
                        </div>

                        <div>
                            <label>Harga (Dalam Rupiah)</label>
                            <input type="text" inputmode="numeric" name="harga" class="input">
                        </div>

                        <div>
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="input">
                        </div>
                        
                        <div class="row">
                            <div class="col-2">
                                <label for="">Hari Tersedia</label>
                            </div>
                            <div style="margin-top:10px;">
                                @php
                                    $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                @endphp
                                @foreach ($hariList as $hari)
                                    <label style="display: inline-block; padding: 10px;">
                                        <input type="checkbox" name="hari_tersedia[]" value="{{ $hari }}"> {{ $hari }}
                                    </label><br>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label for="">Hari Tersedia</label>
                            </div>
                            @php
                                $jamList = ['09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
                            @endphp
                            @foreach ($jamList as $jam)
                                <label style="display: inline-block; width: 80px;">
                                    <input type="checkbox" name="jam_tersedia[]" value="{{ $jam }}"> {{ $jam }}
                                </label><br>
                            @endforeach
                        </div>

                        <div>
                            <input class="btn btn-primary submit" type="submit" value="Simpan">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @include('ownersalon.footer')
</body>
</html>