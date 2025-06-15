<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
    <style>
        .tabel {
            border: 2px solid #9D406D;
            margin: auto;
            margin-top: 20px;
            padding: 20px;
            width: 95%;
        }

        th {
            background: #9D406D;
            padding: 15px;
            color: white;
            text-align: center;
        }

        td {
            padding: 10px;
            vertical-align: middle;
        }

        tr {
            border: 1px solid #9D406D;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h2 class="text-xl font-bold mb-4">Pesan Masuk</h2>
            <table class="table-auto w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Telepon</th>
                        <th class="px-4 py-2">Pesan</th>
                        <th class="px-4 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $msg->name }}</td>
                            <td class="px-4 py-2">{{ $msg->email }}</td>
                            <td class="px-4 py-2">{{ $msg->phone }}</td>
                            <td class="px-4 py-2">{{ $msg->message }}</td>
                            <td class="px-4 py-2">{{ $msg->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
