<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>Invoice {{ $transaction->invoice_number }} | {{ config('app.name') }}</title>
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

    @include('dashboard.transactions.struk')

    {{-- <div class="download-button">
        <button onclick="printStruk()">Download Struk</button>
    </div> --}}

    <script src="{{ asset('vendor/davidshimjs-qrcodejs-04f46c6/qrcode.js') }}"></script>
    <script>
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "{{ $transaction->struk_url }}",
            width: 130,
            height: 130,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        function printStruk() {
            printJS({
                printable: 'receipt',
                type: 'html',
                targetStyles: ['*'],
                documentTitle: 'Struk {{ config('app.name') }}',
                style: '@page { size: 96mm 192mm; margin: 0mm; }',
            });
        }

        window.printStruk = printStruk;
    </script>
</body>

</html>
