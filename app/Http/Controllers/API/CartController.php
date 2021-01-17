<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = new Cart;
        $cart->user_id = $request->user_id;
        $cart->product_id = $request->product_id;
        $cart->size_id = $request->size_id;
        $cart->color_id = $request->color_id;
        $cart->save();

        ProductVariant::where('product_id', $cart->product_id)->decrement('stock');

        if($cart)
            return ResponseFormatter::success($cart, 'Data berhasil ditambah');
        else
            return ResponseFormatter::error(null, 'Data tidak berhasil ditambah', 404); 
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        ProductVariant::where('product_id', $cart->product_id)->increment('stock');
        $cart->delete();

        if($cart)
            return ResponseFormatter::success($cart, 'Data berhasil dihapus');
        else
            return ResponseFormatter::error(null, 'Data tidak berhasil dihapus', 404); 
    }
}
