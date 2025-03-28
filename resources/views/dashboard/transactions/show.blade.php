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
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-3">
        <div class="flex flex-col gap-9 col-span-2">
            <!-- Contact Form -->

            <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                <div class="border-b border-gray-300 px-6 py-4 flex justify-between">
                    <h3 class="font-medium text-black">
                        Detail Order
                    </h3>

                </div>
                <div class="flex px-6">
                    @if ($transaction->order->member)
                        <div class="p-2 w-full xl:w-1/2">
                            <div class="border-b border-gray-200 pb-2">
                                <h1 class="font-bold text-lg">Detail Member</h1>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div>
                                    <h3 class="font-bold text-md py-2">Nama Member</h3>
                                    <p>{{ $transaction->order->member->full_name }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Nomor Telepon</h3>
                                    <p>{{ $transaction->order->member->no_telp }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Total Poin</h3>
                                    <p>{{ number_format($transaction->order->member->point, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-md py-2">Status Member</h3>
                                    <p
                                        class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium {{ $transaction->order->member->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $transaction->order->member->status }}
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
                                    <p class="text-red-600">- {{ number_format($transaction->point_usage, 0, ',', '.') }}
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
                @if($transaction->order->member)
                    <div class="p-6.5">
                        <button id="sendInvoice" type="button" value="{{ $transaction->order->member->no_telp }}"
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
                                        <img src="src/images/product/product-01.png" alt="Product {{ $index + 1 }}" />
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
                    @include('dashboard.transactions.struk')
                    @if ($transaction->payment_status == 'unpaid' || $transaction->payment_status == 'pending')
                        <form
                            action="{{ route('dashboard.transactions.payment.updateStatus', ['transaction' => $transaction->id]) }}"
                            method="post" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="payment_status" value="paid">
                            <button type="submit"
                                class="flex w-full justify-center rounded bg-green-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                                Selesaikan Pembayaran
                            </button>
                        </form>
                    @else
                        <button type="button"
                            onclick="cetakStruk('{{ route('dashboard.transactions.print', ['transaction' => $transaction->id]) }}')"
                            class="flex w-full justify-center rounded bg-red-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                            Print Struk
                        </button>
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

            newWindow.onload = function() {
                newWindow.document.body.style.transform = 'scale(0.8)';
                newWindow.document.body.style.transformOrigin = 'top left';
                newWindow.document.body.style.width = '125%';
                newWindow.document.body.style.height = '125%';
                newWindow.document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    newWindow.printStruk();
                }, 1500);
                newWindow.onfocus = () => {
                    newWindow.close();
                }
            };
        }
    </script>
@endpush
