<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionUserController extends Controller
{
    public function index()
    {

        $sellTransaction = TransactionDetail::with(['transaction.user','product.gallery'])->whereHas('product', function($product){
            $product->where('user_id', Auth::user()->id);
        })->orderBy('id','DESC')->limit(10)->get();

        $buyTransaction = TransactionDetail::with(['transaction.user','product.gallery'])->whereHas('transaction', function($transaction){
            $transaction->where('user_id', Auth::user()->id);
        })->orderBy('id','DESC')->limit(10)->get();

        return view('pages.front.user-transaction' , compact([
            'sellTransaction','buyTransaction'
        ]));
    }

    public function detail($id)
    {
        $transaction = TransactionDetail::with(['transaction.user','product.gallery'])->find($id);
        return view('pages.front.detail-user-transaction', compact('transaction'));
    }

    public function update(Request $request , $id)
    {
        $data = $request->all();
        $item = TransactionDetail::find($id);
        $item->update($data);
        return redirect()->back()->with('info','Shipping Status Berhasil Dirubah');
    }

}
