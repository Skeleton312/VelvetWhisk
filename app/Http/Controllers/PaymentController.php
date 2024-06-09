<?php

namespace App\Http\Controllers;
use App\Models\Payment; 
use App\Models\OrderItem; 
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Bank;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create(Request $request){
        $params = array(
            'transaction_details'=> array( 
                'order_id'=>Str::uuid(),
                'gross_amount'=> $request->price,
            ),
            'item_details'=> array(
                array(
                    'price'=>$request ->price,
                    'quantity'=>1,
                    'name'=>$request->item_name,
                )
                ),
                'customer_details'=> array(
                    'user_id'=> $request->user_id,
                ),
            );
            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization'=> "Basic $auth",
            ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions',$params);

            $response = json_decode($response->body());

            $payment = new Payment;
            $payment->order_id=$params['transaction_details']['order_id'];
            $payment->payment_status ='pending';
            $payment->payment_amount =$request->price;
            $payement->user_id=$request->user_id;
            $payment->customer_email = $request->customer_email;
            $payment->item_name =$request->item_name;
            $payment->checkout_link= $response->redirect_url;
            $payement->save();

            return response()->json($response);
    }
    public function beli(Request $request){

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
    }
    public function transactionShow()
    {
        $user = Auth::user();
        $transactions = Payment::where('user_id', $user->id)->with('orderItems')->get();
        return view('web.transaction', ['transactions' => $transactions]);
    }
    public function paymentShow(Request $request)
    {
        $id = $request->input('id_payment'); // Mengambil id_payment dari request
        $transactions = Payment::where('id', $id)->with('orderItems')->find($id);
        $bank = Bank::where('id', $transactions->payment_link)->first();
        return view('web.payment', ['transactions' => $transactions, 'bank'=>$bank]);
    }
    public function updateStatus(Request $request)
    {
        $id = $request->input('id_payment');
        $transaction = Payment::find($id);

        if ($transaction) {
            $transaction->payment_status = 'Dikirim';
            $transaction->save();
        }

        return redirect()->route('transaction.show'); 
    }
    public function markAsComplete(Request $request)
    {
        $id = $request->input('id_payment');
        $transaction = Payment::find($id);

        if ($transaction) {
            $transaction->payment_status = 'Selesai';
            $transaction->save();
        }

        return redirect()->route('transaction.show');
    }
    public function processCheckout(Request $request)
    {
        $userId = auth()->user()->id;
        // Store order items
        // Store payment
        $payment = Payment::create([
            'user_id' => $userId,
            'payment_amount' => $request->payment_amount, 
            'payment_link'=> $request->paymentMethod
        ]);
        $paymentId = $payment->id;

        // Store order items with associated payment ID
        foreach ($request->items as $item) {
            OrderItem::create([
                'user_id' => $userId,
                'order_id' => $paymentId, // Use the payment ID as the order ID
                'product_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
            ]);
        }
        foreach ($request->items as $item) {
            Cart::where('id_user', $userId)
                ->where('product_id', $item['id'])
                ->delete();
        }
        // \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;
        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => rand(),
        //         'gross_amount' => $payment->payment_amount,
        //     ),
        //     'customer_details' => array(
        //         'first_name' => Auth::user()->name,
        //         'email' => Auth::user()->email,
        //         'phone' => Auth::user()->no_hp,
        //     ),
        // );
        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        // $payment->payment_link = $snapToken;
        // $payment->save();
        // Redirect or do any additional actions after processing checkout
        return redirect()->route('transaction.show');
    }
    public function deleteTransaction(Request $request){
        $id=$request->id_payment;
        OrderItem::where('order_id', $id)
            ->delete();
        Payment::where('id',$id)
            ->delete();
        return redirect()->route('transaction.show');
    }
}
