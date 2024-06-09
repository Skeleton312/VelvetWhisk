<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    @include('include.style')
</head>
<body>
    <div class="payment-parent">
        <div class="container-payment">
            <h1>Pembayaran</h1>
            <h6>Transfer ke rekening sesuai total dan upload bukti pembayaran.</h6>
            <div class="detail-payment">
            @foreach($transactions->orderItems as $orderItem)
                <div class="produk-payment">
                    <p>{{ $orderItem->product->nama }}</p>
                    <p>{{ $orderItem->quantity }}x {{ number_format($orderItem->price, 2, ',', '.') }}</p>
                </div>
                <div>Subtotal: {{ number_format($orderItem->subtotal, 2, ',', '.') }} </div>
            </div>
            @endforeach
            <div class="payment-detil"></div>
            <h5>Metode Pembayaran: Transfer {{ $transactions->payment_link }}</h5>
            <h5>No Rekening Transfer: {{$bank->rekening}}</h5>
            <h5>Total Pembayaran: {{ number_format($transactions->payment_amount, 0, ',', '.') }}</h5>
            <form action="{{ route('payment.updateStatus') }}" method="POST">
            <div class="bukti">
                <label>Bukti Pembayaran: </label>
                <input type="file" name="bukti" placeholder="upload bukti di sini" required>
            </div>
                @csrf
                <input type="hidden" name="id_payment" value="{{ $transactions->id }}">
                <button type="submit" class="bayar-tombol">Bayar Sekarang</button>
            </form>
            <a class="kembali-tombol" href="javascript:history.back()">Kembali</a>
        </div>
    </div>
</body>
</html>