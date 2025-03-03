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
            @if ($transaction->member)
                <div
                    class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                    <div class="border-b border-gray-300 px-6.5 py-4  ">
                        <h3 class="font-medium text-black  ">
                            Detail Member
                        </h3>
                    </div>
                    <div class="p-6.5">
                        <button
                            class="flex w-full justify-center rounded bg-red-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                            Send Invoice
                        </button>
                    </div>
                </div>
            @endif
            <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                <div class="border-b border-gray-300 px-6.5 py-4  ">
                    <h3 class="font-medium text-black  ">
                        Detail Order
                    </h3>
                </div>
                <div class="p-6.5">
                    <button
                        class="flex w-full justify-center rounded bg-red-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                        Send Invoice
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-9">
            <!-- Sign In Form -->
            <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                <div class="border-b border-gray-300 px-6.5 py-4  ">
                    <h3 class="font-medium text-black  ">
                        Struk Pembayaran
                    </h3>
                </div>
                <div class="p-6 flex flex-col items-center justify-center">
                    <div id="receipt" class="receipt">
                        <img src="{{ asset('static/logo-340x180.png') }}" width="200" class="center" alt="">
                        <p>Jln. Lorem ipsum dolor sit amet</p>
                        <p>No. 66 Cakung, Jakarta Timur, Jakarta</p>
                        <p>No. Telp 08123456789</p>
                        <hr>
                        <p>{{ \Carbon\Carbon::parse($transaction->order->created_at)->locale('id')->translatedFormat('l, d F Y H:i') }}
                            WIB</p>
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
                        <p class="link">Akses struk digital dibawah ini</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $transaction->struk_url }}"
                            alt="" class="center link" width="70" />
                    </div>
                    <button type="button"
                        onclick="cetakStruk('{{ route('dashboard.transactions.print', ['transaction' => $transaction->id]) }}')"
                        class="flex w-full justify-center rounded bg-red-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                        Download Struk
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- ====== Form Layout Section End -->
@endsection

@push('scripts')
    <script>
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
