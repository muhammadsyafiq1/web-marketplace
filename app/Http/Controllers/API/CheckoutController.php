<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function proccessCheckout(Request $request)
    {
        // ambil data user lalu update
        $user = User::find($request->user_id);
        $user->address_one = $request->address_one;
        $user->address_two = $request->address_two;
        $user->provinces_id = $request->provinces_id;
        $user->regencies_id = $request->regencies_id;
        $user->districts_id = $request->districts_id;
        $user->zip_code = $request->zip_code;
        $user->phone_number = $request->phone_number;
        $user->save();

        // ambil isi cart si user
        $transaction_code = 'Transaction-'. mt_rand(000000,999999);
        $carts = Cart::with(['user','product.productvariant'])
            ->where('user_id', $user->id)
            ->get();
        
        // create transaction
        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'pending',
            'transaction_code' => $transaction_code
        ]);

        // bongkar cart nya masukin ke detail
        foreach($carts as $cart){
            $transaction_detail_code = 'DETAIL-'. mt_rand(000000,999999);
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product->id,
                'price' => $cart->product->productvariant->first()->price,
                'shipping_status' => 'pending',
                'resi' => '',
                'transaction_detail_code' => $transaction_detail_code
            ]);
        }

        // hapus cart setelah belanja
        $cart = Cart::where('user_id', $user->id)->delete();

        if($transaction)
            return ResponseFormatter::success($transaction, 'checkout berhasil');
        else
            return ResponseFormatter::error(null, 'checkout tidak berhasil', 404); 

    }
}
