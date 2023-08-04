<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Order</title>
    <style>
        /* Add any custom styling for the PDF here */
        /* For example, you can style tables, headings, etc. */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>All Order</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>PEMBELI</th>
                <th>PRODUK</th>
                <th>HARGA</th>
                <th>TANGGAL</th>
                <th>PEMBAYARAN</th>
                <th>PENGIRIMAN</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($order as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pembeli }}</td>
                <td>{{ $item->name }}</td>
                <td>Rp. {{ $item->price }}</td>
                <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->status_pengiriman }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No Data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
