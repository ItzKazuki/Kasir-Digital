@extends('layouts.dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/struk.css') }}">
@endpush
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black  ">
            Transaksi: {{ $transaction->invoice_number }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                </li>
                <li class="font-medium">Transaksi /</li>
                <li class="font-medium text-red-600"><a
                        href="{{ route('dashboard.transactions.show', ['transaction' => $transaction->id]) }}">{{ $transaction->invoice_number }}</a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- ====== Form Layout Section Start -->
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1 lg:grid-cols-2">
        <div class="flex flex-col gap-9 col-span-2">
            <!-- Contact Form -->

            <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                <div class="border-b border-gray-300 px-6 py-4 flex justify-between">
                    <h3 class="font-medium text-black">
                        Detail Order
                    </h3>

                </div>
                <div class="flex px-6">
                    @if ($transaction->member)
                        <div class="p-2 w-full xl:w-1/2">
                            <div class="border-b border-gray-200 pb-2">
                                <h1 class="font-bold text-lg">Detail Member</h1>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div>
                                    <h3 class="font-bold text-md py-2">Nama Member</h3>
                                    <p>{{ $transaction->member->full_name }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Nomor Telepon</h3>
                                    <p>{{ $transaction->member->no_telp }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Total Poin</h3>
                                    <p>{{ number_format($transaction->member->point, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Status Member</h3>
                                    <p
                                        class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium {{ $transaction->member->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $transaction->member->status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="p-2 w-full xl:w-1/2">
                        <div class="border-b border-gray-200 pb-2">
                            <h1 class="font-bold text-lg">Detail Transaksi</h1>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div>
                                <h3 class="font-bold text-md py-2">Metode Pembayaran</h3>
                                <p
                                    class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium border border-gray-600 bg-gray-100">
                                    {{ $transaction->payment_method }}
                                </p>
                            </div>
                            <div>
                                <h3 class="font-bold text-md py-2">Total Harga</h3>
                                <p>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex gap-8">
                                <div>
                                    <h3 class="font-bold text-md py-2">Uang Masuk</h3>
                                    <p class="text-green-600">Rp. {{ number_format($transaction->cash, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Uang Keluar</h3>
                                    <p class="text-red-600">- Rp.
                                        {{ number_format($transaction->cash_change, 0, ',', '.') }}
                                    </p>
                                </div>
                                @if ($transaction->point_usage)
                                    <div>
                                        <h3 class="font-bold text-md py-2">Point Digunakan</h3>
                                        <p class="text-red-600">-
                                            {{ number_format($transaction->point_usage, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-md py-2">Nama Kasir</h3>
                                <p class="text-black">{{ $transaction->order->user->full_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($transaction->member)
                    <div class="p-6.5">
                        <button id="sendInvoice" type="button" value="{{ $transaction->member->no_telp }}"
                            class="flex w-full justify-center rounded bg-red-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                            Send Invoice to Whatshapp
                        </button>
                    </div>
                @endif
            </div>
            <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                <div class="border-b border-gray-300 px-6.5 py-4 flex justify-between">
                    <h3 class="font-medium text-black  ">
                        Detail Order
                    </h3>
                    <p
                        class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-600">
                        Jumlah barang {{ $transaction->order->orderDetails->sum('quantity') }}
                    </p>
                </div>
                <div class="rounded-sm border-gray-300 bg-white shadow-default">
                    <div class="grid grid-cols-6 border-gray-300 bg-gray-200 px-4 py-4 sm:grid-cols-8 md:px-6 2xl:px-7.5">
                        <div class="col-span-1 flex items-center">
                            <p class="font-medium">#</p>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="font-medium">Product Name</p>
                        </div>
                        <div class="col-span-1 hidden items-center sm:flex">
                            <p class="font-medium">Category</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="font-medium">Price</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="font-medium">Quantity</p>
                        </div>
                    </div>

                    @foreach ($transaction->order->orderDetails as $index => $orderDetail)
                        <div class="grid grid-cols-6 px-4 py-4 border-gray-300 border-t sm:grid-cols-8 md:px-6 2xl:px-7.5">
                            <div class="col-span-1 hidden items-center sm:flex">
                                <p class="text-medium font-medium text-black">{{ $index + 1 }}</p>
                            </div>
                            <div class="col-span-2 flex items-center">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                    <div class="h-12.5 w-15 rounded-md">
                                        <img src="{{ $orderDetail->product->product_image }}" alt="Product {{ $index + 1 }}" />
                                    </div>
                                    <p class="text-medium font-medium text-black">
                                        {{ $orderDetail->product->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-span-1 hidden items-center sm:flex">
                                <p class="text-medium font-medium text-black">{{ $orderDetail->product->category->name }}
                                </p>
                            </div>
                            <div class="col-span-1 flex items-center">
                                <p class="text-medium font-medium text-black">Rp.
                                    {{ number_format($orderDetail->product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-span-1 flex items-center">
                                <p class="text-medium font-medium text-black">{{ $orderDetail->quantity }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-9">
            <!-- Sign In Form -->
            <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                <div class="border-b border-gray-300 px-6.5 py-4 flex justify-between">
                    <h3 class="font-medium text-black  ">
                        Struk Pembayaran
                    </h3>
                    <p
                        class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium {{ $transaction->payment_status == 'paid' ? 'bg-green-100 text-green-600' : ($transaction->payment_status == 'unpaid' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600') }}">
                        {{ $transaction->payment_status }}
                    </p>
                </div>
                <div class="p-6 flex flex-col items-center justify-center">
                    @if ($transaction->payment_status == 'paid')
                        @include('dashboard.transactions.struk')
                    @elseif ($transaction->payment_status == 'pending' && $transaction->payment_method == 'qris')
                        <div class="flex flex-col items-center">
                            <h3 class="text-lg font-bold text-gray-700 mb-4">Bayar Sekarang</h3>
                            <img src="{{ $transaction->payment_url }}" alt="QRIS Payment" class="w-[250px] mb-4">
                            <p class="text-sm text-gray-600 mb-2">Scan QR Code di atas untuk melakukan pembayaran.</p>
                            <p class="text-sm text-gray-600">Pastikan pembayaran dilakukan sebelum batas waktu yang
                                ditentukan.</p>
                        </div>

                        <button id="checkPayment" onclick="cekPembayaran()"
                            type="button"
                            class="flex w-full justify-center rounded bg-green-600 text-white p-3 font-medium hover:bg-opacity-90">
                            Cek Pembayaran
                        </button>
                    @endif
                    @if (
                        $transaction->payment_status == 'unpaid' ||
                            ($transaction->payment_status == 'pending' && $transaction->payment_method != 'qris'))
                        <form
                            action="{{ route('dashboard.transactions.payment.updateStatus', ['transaction' => $transaction->id]) }}"
                            method="post" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="payment_status" value="paid">
                            <button type="submit"
                                class="flex w-full justify-center rounded bg-green-600 text-white p-3 font-medium hover:bg-opacity-90">
                                Selesaikan Pembayaran
                            </button>
                        </form>
                    @elseif ($transaction->payment_status == 'paid')
                        <a href="{{ route('dashboard.transactions.pdf', ['transaction' => $transaction->id]) }}"
                            target="_blank"
                            class="flex w-full justify-center rounded bg-red-600 text-white p-3 font-medium hover:bg-opacity-90">
                            Download Struk
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Form Layout Section End -->
@endsection

@push('scripts')
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

        function cekPembayaran() {
            var url =
                "{{ route('dashboard.transactions.payment.checkStatus', ['transaction' => $transaction->id]) }}";
            axios.post(url)
                .then(response => {
                    if (response.data.transaction_status == 'settlement') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil',
                            text: 'Status pembayaran telah diperbarui.',
                        }).then(() => {
                            location.reload();
                        });
                    } else if (response.data.stattransaction_statusus == 'pending') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Pembayaran Pending',
                            text: 'Pembayaran masih dalam proses.',
                        });

                    } else if (response.data.transaction_status == 'expire') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembayaran Kadaluarsa',
                            text: 'Pembayaran telah kadaluarsa.',
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembayaran Gagal',
                            text: 'Status pembayaran tidak valid.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memeriksa status pembayaran.',
                    });
                });
        }

        document.getElementById('sendInvoice').addEventListener('click', function() {
            var url = "{{ route('dashboard.transactions.send.whatsapp', ['transaction' => $transaction->id]) }}";
            axios.post(url, {
                    phone: this.value
                })
                .then(response => {
                    if (response.data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Invoice berhasil dikirimkan ke WhatsApp',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Invoice gagal dikirimkan ke WhatsApp',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim invoice',
                    });
                });
        });

        function cetakStruk(url) {
            // return window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes')
            var newWindow = window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');

            newWindow.print();
        }
    </script>
@endpush
