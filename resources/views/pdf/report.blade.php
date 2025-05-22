<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Laporan Transaksi</h2>
    {{-- <p>Bulan: {{ $month ? \Carbon\Carbon::create()->month($month)->format('F') : 'Semua' }}</p> --}}
    <p>Bulan:
        {{ $month ? \Carbon\Carbon::createFromDate(null, intval($month), 1)->format('F') : 'Semua' }}
    </p>

    <p>Tahun: {{ $year }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $i => $trx)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->order_date)->format('d-m-Y') }}</td>
                    <td>{{ $trx->invoice_number ?? '-' }}</td>
                    <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
