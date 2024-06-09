<!DOCTYPE html>
<html>
<head>
    <title>Laporan Analisa Kepuasan</title>
    <style>
        /* Atur tampilan cetak di sini */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Laporan Analisa Kepuasan</h1>
    <table>
        <thead>
            <tr>
                <th>ID Tiket</th>
                <th>Pemesan</th>
                <th>Sektor</th>
                <th>Foto Bukti</th>
                <th>Skor Kepuasan</th>
                <th>Skor Customer Effort</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($analisaKepuasans as $item)
                <tr>
                    <td>{{ $item->id_tiket }}</td>
                    <td>{{ $item->pemesan }}</td>
                    <td>{{ $item->sektor }}</td>
                    <td>
                        @if ($item->foto_bukti)
                            <img src="{{ asset('uploads/'.$item->foto_bukti) }}" alt="Foto bukti">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    <td>{{ $item->skor_kepuasan }}</td>
                    <td>{{ $item->skor_customer_effort }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
