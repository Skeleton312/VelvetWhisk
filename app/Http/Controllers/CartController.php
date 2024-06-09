<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ShippingAddress; 
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        // Mendapatkan semua item dalam keranjang belanja untuk pengguna yang masuk
        $cartItems = Cart::where('id_user', auth()->id())->get();
        $user_id = Auth::id();
        $shippingAddress = ShippingAddress::where('id_user', $user_id)->first();
    
        // Mengembalikan view blade.php dan meneruskan data $cartItems ke view
        return view('components.cart', ['cartItems'=>$cartItems, 'shippingAddress'=>$shippingAddress]);
    }
    public function store(Request $request)
    {
        // Cari apakah produk sudah ada di keranjang
        $cart = Cart::where('product_id', $request->product_id)->where("id_user", Auth::User()->id )->first();

        if ($cart) {
            // Jika produk sudah ada di keranjang, tambahkan jumlahnya
            $cart->jumlah += 1;
            $cart->save();
        } else {
            // Jika produk belum ada di keranjang, tambahkan produk ke keranjang
            Cart::create([
                'product_id' => $request->product_id,
                'id_user' => Auth::user()->id,
                'jumlah' => 1,
            ]);
            $message = 'Produk berhasil ditambahkan ke keranjang.';
        }

        return redirect()->route('cart.show');
    }
    public function updateCart(Request $request)
    {
        $product_id = $request->product_id;
        $action = $request->action;
        $user_id = Auth::id();

        // Find the cart item
        $cart = Cart::where('product_id', $product_id)->where('id_user', $user_id)->first();

        if ($cart) {
            if ($action === 'increase') {
                $cart->jumlah += 1;
            } elseif ($action === 'decrease' && $cart->jumlah > 1) {
                $cart->jumlah -= 1;
            }

            $cart->save();

            return response()->json([
                'success' => true,
                'new_quantity' => $cart->jumlah
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    public function showCheckout(Request $request)
    {
        // Decode the JSON data from the form input
        $selectedItems = json_decode($request->input('selected_items'), true);
        $totalPrice = $request->input('total_price');

        // Retrieve the user's shipping address
        $userId = Auth::id();
        $shippingAddress = ShippingAddress::where('id_user', $userId)->first();
        $totalSelectedItems = count($selectedItems);

        // Pass the data to the view
        return view('components.checkout', [
            'selectedItems' => $selectedItems,
            'totalPrice' => $totalPrice,
            'shippingAddress' => $shippingAddress,
            'total'=>$totalSelectedItems
        ]);
    }
    public function showSingleItemCheckout(Request $request)
    {
        // Retrieve the single product ID from the request
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        $totalPrice=$product->harga;
        $selectedItems = [[
            'id'=> $productId,
            'name'=>$product->nama,
            'quantity'=> 1,
            'price'=>$product->harga,
            'subtotal'=>$product->harga
        ]];
        $totalSelectedItems = 1;
        // Retrieve the user's shipping address
        $userId = Auth::id();
        $shippingAddress = ShippingAddress::where('id_user', $userId)->first();
        if ($shippingAddress){
            return view('components.checkout', [
                'selectedItems' => $selectedItems,
                'shippingAddress' => $shippingAddress,
                'total'=>$totalSelectedItems,
                'totalPrice' => $totalPrice,
            ]);
        }
        else{
            return redirect()->route('address');
        }
        // Pass the data to the view

    }
    public function deleteCart(Request $request){
         // Decode the JSON data from the form input
         $selectedItems = json_decode($request->input('cart_id'), true);
         foreach ($selectedItems as $item) {
            Cart::where('id_cart', $item['id'])
                ->delete();
        }
        return redirect()->route('cart.show');
    }

}
