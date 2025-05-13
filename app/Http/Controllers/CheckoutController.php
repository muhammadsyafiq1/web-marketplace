<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comentar;
use App\Models\Product;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
   public function proccessCheckout(Request $request)
   {
        //update user
        $user  = Auth::user();
        $user->update($request->except('total_price'));

        // buat code transaction
        $transaction_code = 'Transaction-'. mt_rand(000000,999999);

        // ambil cart user
        $carts = Cart::with(['user','product.productvariant'])
            ->where('user_id', $user->id)
            ->get();

        // create transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
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
                'price' => $cart->product->price,
                'shipping_status' => 'pending',
                'resi' => '',
                'transaction_detail_code' => $transaction_detail_code
            ]);

            Comentar::create([
                'user_id' => Auth::user()->id,
                'product_id' => $cart->product->id,
                'content' => ''
            ]);
        }


        // hapus cart setelah belanja
        $cart = Cart::where('user_id', $user->id)->delete();

        return view('pages.front.success');

        //KONFIGURASI MIDTRANS
        // Config::$serverKey = config('services.midtrans.serverKey');
        // Config::$isProduction = config('services.midtrans.isProduction');
        // Config::$isSanitized = config('services.midtrans.isSanitized');
        // Config::$is3ds = config('services.midtrans.is3ds');

        //  //KONFIGURASI MIDTRANS
        //  $midtrans = [
        //     'transaction_details' => [
        //         'order_id' => $transaction_code,
        //         'gross_amount' => (int) $request->total_price,
        //     ],
        //     'customer_details' => [
        //         'first_name' => Auth::user()->name,
        //         'email' => Auth::user()->email,
        //     ],
        //     'enabled_payments' => [
        //         'gopay', 'permata_va', 'bank_transfer'
        //     ],
        //     'vtweb' => []
        // ];

        // try {
        //     //get snap payment page url
        //     $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
        //     // redirect to snap payment page
        //     return redirect($paymentUrl);
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }
   }
}
