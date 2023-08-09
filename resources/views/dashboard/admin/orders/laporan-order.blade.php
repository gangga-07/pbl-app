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
        h2 {
            text-align: center; /* Set text alignment to center */
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Order Bulanan</h2>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>PEMBELI</th>
                <th>PRODUK</th>
                <th>HARGA</th>
                <th>TANGGAL</th>
                <th>PEMBAYARAN</th>
                <th>PENGIRIMAN</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalPrice = 0; ?>
            @forelse ($order as $item)
            @if ($item->status === 'paid' && $item->status_pengiriman === 'Terkirim')
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pembeli }}</td>
                <td>{{ $item->name }}</td>
                <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                <td class="text-center">{{ $item->status }}</td>
                <td class="text-center">{{ $item->status_pengiriman }}</td>
            </tr>
            <?php $totalPrice += $item->price; ?>
            @endif
            @empty
            <tr>
                <td colspan="7">No Data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <p><strong>Total Pembelian Bulan {{ date('F', strtotime($item->tanggal)) }}: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</strong></p>
</body>
</html>
