<div id="receipt" class="receipt">
    <img src="{{ asset('static/logo-340x180.png') }}" width="200" class="center" alt="">
    <p>{{ config('app.address') }}</p>
    <p>No. Telp {{ config('app.fonnte.phone_number') }}</p>
    <hr>
    <p>{{ \Carbon\Carbon::parse($transaction->order->created_at)->locale('id')->translatedFormat('l, d F Y H:i') }} WIB
    </p>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Qty</th>
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
    @if ($transaction->point_usage)
        <div class="uang">
            <span>Poin Digunakan</span>
            <span>{{ number_format($transaction->point_usage, 0, ',', '.') }}</span>
        </div>
    @endif
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
    <div id="qrcode" class="center link"></div>
</div>
