<?php

namespace App\Http\Controllers;
use App\Models\ShippingAddress; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class shippingAddressController extends Controller
{

  public function addressForm(){
    Session::put('previousUrl', url()->previous());
    $user = Auth::user();
    $shippingAddress = ShippingAddress::where('id_user', $user->id)->first();
    return view('components.address',['shippingAddress'=>$shippingAddress]);
  }
  public function editAddress(Request $request){
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Cek apakah alamat pengiriman sudah ada untuk user yang sedang login
        $shippingAddress = ShippingAddress::where('id_user', $user->id)->first();

        if ($shippingAddress) {
            // Jika alamat pengiriman sudah ada, update data
            $shippingAddress->update([
                'penerima' => $request->input('penerima'),
                'patokan' => $request->input('patokan'),
                'jalan' => $request->input('jalan'),
                'kecamatan' => $request->input('kecamatan'),
                'kabupaten' => $request->input('kabupaten'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'status' => $request->input('status')
            ]);
        } else {
            // Jika alamat pengiriman belum ada, buat data baru
            $shippingAddress = new ShippingAddress([
                'id_user' => $user->id,
                'penerima' => $request->input('penerima'),
                'patokan' => $request->input('patokan'),
                'jalan' => $request->input('jalan'),
                'kecamatan' => $request->input('kecamatan'),
                'kabupaten' => $request->input('kabupaten'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'status' => $request->input('status')
            ]);
            $shippingAddress->save();
        }
      $previousUrl = Session::get('previousUrl');

      Session::forget('previousUrl');

      return redirect($previousUrl ?: '/');
  
  }
}
