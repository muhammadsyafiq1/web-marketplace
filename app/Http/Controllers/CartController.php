<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['productvariant.size','productvariant.color','user','product.gallery','product'])
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('pages.front.cart', compact('carts'));
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);

        // tambah stock
        $productvariant = ProductVariant::where('id', $cart->product_variant_id);
        $productvariant->increment('stock');

        $cart->delete();
        
        if(Cart::count() > 0) {
            return redirect()->back()->with('info','Item berhasil Dihapus.');
        } else {
            return redirect(route('home'));
        }
    }
}