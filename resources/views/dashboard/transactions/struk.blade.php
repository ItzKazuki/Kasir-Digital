<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>Kasir Digital</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* background-color: #f3f4f6; */
            margin: 0;
            font-family: Arial, sans-serif;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/struk.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js"
        integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.css"
        integrity="sha512-tKGnmy6w6vpt8VyMNuWbQtk6D6vwU8VCxUi0kEMXmtgwW+6F70iONzukEUC3gvb+KTJTLzDKAGGWc1R7rmIgxQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="receipt" class="receipt">
        <img src="{{ asset('static/logo-340x180.png') }}" width="200" class="center" alt="">
        <p>Jln. Lorem ipsum dolor sit amet</p>
        <p>No. Telp 08123456789</p>
        <hr>
        <p>{{ \Carbon\Carbon::parse($transaction->order->created_at)->locale('id')->translatedFormat('l, d F Y H:i') }}
            WIB
        </p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>QTY</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->order->orderDetails as $orderDetail)
                    <tr>
                        <td class="qty">{{ $orderDetail->quantity }}</td>
                        <td style="text-align: left;">{{ $orderDetail->product->name }}</td>
                        <td>Rp. {{ number_format($orderDetail->product->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <div class="total">
            <span>Total</span>
            <span>{{ number_format($transaction->order->total_price, 0, ',', '.') }}</span>
        </div>
        <div class="uang">
            <span>Uang</span>
            <span>{{ number_format($transaction->cash, 0, ',', '.') }}</span>
        </div>
        <div class="kembalian">
            <span>Kembalian</span>
            <span>{{ number_format($transaction->cash_change, 0, ',', '.') }}</span>
        </div>
        <hr>
        <p class="thanks">Terima Kasih</p>
        <p class="link">Akses struk digital di bawah ini</p>
        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $transaction->struk_url }}" alt="" class="center link"
            width="70" />
    </div>

    <div class="download-button">
        <button onclick="printStruk()">Download Struk</button>
    </div>

    <script>
        function printStruk() {
            printJS({
                printable: 'receipt',
                type: 'html',
                targetStyles: ['*'],
                documentTitle: 'Struk Kasir Digital',
                style: '@page { size: 96mm 192mm; margin: 0mm; }',
            });
        }

        window.printStruk = printStruk;

        // document.addEventListener('DOMContentLoaded', function () {
        //     // Deteksi jika print selesai
        //     setTimeout(() => {
        //         // window.history.back(); // Kembali ke halaman sebelumnya setelah print selesai
        //         printStruk();
        //     }, 2000);
        // });

        // setTimeout(() => {
        //         // window.history.back(); // Kembali ke halaman sebelumnya setelah print selesai
        //         window.onfocus = function () {
        //             // window.history.back(); // Kembali ke halaman sebelumnya ketika tab aktif
        //             window.close(); // Menutup tab setelah print selesai
        //         };
        //     }, 4000);
    </script>
</body>

</html>
