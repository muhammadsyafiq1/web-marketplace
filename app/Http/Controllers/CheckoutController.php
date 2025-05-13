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
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function proccessCheckout(Request $request)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Update data user kecuali total_price
            $user = Auth::user();
            $user->update($request->except('total_price'));

            // Buat kode transaksi
            $transaction_code = 'TRANSACTION-' . mt_rand(100000, 999999);

            // Ambil isi keranjang user
            $carts = Cart::with(['product'])->where('user_id', $user->id)->get();

            // Buat transaksi utama
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'insurance_price' => 0,
                'shipping_price' => 0,
                'total_price' => $request->total_price,
                'transaction_status' => 'pending',
                'transaction_code' => $transaction_code,
            ]);

            // Loop cart dan simpan ke detail transaksi
            foreach ($carts as $cart) {
                $detail_code = 'DETAIL-' . mt_rand(100000, 999999);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product->id,
                    'price' => $cart->product->price,
                    'shipping_status' => 'pending',
                    'resi' => '',
                    'transaction_detail_code' => $detail_code,
                ]);
            }

            // Hapus keranjang
            Cart::where('user_id', $user->id)->delete();

            // Commit transaksi
            DB::commit();

            // Arahkan ke halaman success
            return view('pages.front.success');
        } catch (\Exception $e) {
            DB::rollback(); // Batalkan semua perubahan
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
