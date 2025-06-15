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
    @include('admin.header')
        @include('admin.sidebar')

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
    //                  'harga' --}}
                    <form action="{{url('tambah_layanan')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="input">
                        </div>

                        <div>
                            <label>Deskripsi Layanan</label>
                            <textarea name="deskripsi_layanan" id="" cols="53" rows="5"></textarea>
                        </div>

                        <div>
                            <label>Harga (Dalam Rupiah)</label>
                            <input type="text" inputmode="numeric" name="harga" class="input">
                        </div>

                        

                        <div>
                            <input class="btn btn-primary submit" type="submit" value="Simpan">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @include('admin.footer')
</body>
</html>