<x-app-layout>
<div class="transaction-parent">
        @if($transactions->isEmpty())
        <b>Belum ada Transaksi.</b>
        @else
            @foreach($transactions as $transaction)
                <div class="cart">
                    <div class="product-info">
                        @foreach($transaction->orderItems as $orderItem)
                                <p>{{ $orderItem->product->nama }} {{ $orderItem->quantity }}x  ->{{ number_format($orderItem->price, 2, ',', '.') }}</p>
                                <p>Subtotal: {{ number_format($orderItem->subtotal, 2, ',', '.') }}</p>
                        @endforeach
                        <p>Transfer {{ $transaction->payment_link }}</p>
                        <p class="harga-total"><a>Total Payments: Rp </a>{{ number_format($transaction->payment_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="status">
                        <p class="status-card" style="padding-left:4rem;" >{{ $transaction->payment_status }}</p>
                        @if($transaction->payment_status == 'Dikirim')
                        <form action="{{ route('payment.markAsComplete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_payment" value="{{ $transaction->id }}">
                                <button style="background-color:green;" type="submit" class="tombol-status">Selesai</button>
                        </form>
                        @elseif($transaction->payment_status == 'Selesai')

                        @else
                        <div class="beli-batal">
                            <form action="{{route('delete.transaction')}}" method='post'>
                                @csrf 
                                <input type="hidden" name="id_payment" value="{{$transaction->id}}">
                                <button style="color:#9b3a45;" type="submit" >Batalkan</button>
                            </form>
                            <form action="/payment" method="POST">
                                @csrf
                                <input type="hidden" name="id_payment" value="{{ $transaction->id }}">
                                <button type="submit" class="tombol-status">Bayar</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
