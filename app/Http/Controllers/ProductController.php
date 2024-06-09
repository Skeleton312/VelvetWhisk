<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(){
        $product = Product::all();

        return view('web.product',compact('product'));
    }
    public function filterByCategory($kategori){
       
        $product = Product::where('kategori', $kategori)->get();
        return view('web.product', compact('product'));
    }
    public function etalase(){
        ;

    }

}
