<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $transactions = transactionDetail::with(['transaction.user','product.gallery'])
                                        ->whereHas('product', function($product){
                                        $product->where('user_id', Auth::user()->id);
                                    });
        $revenue = $transactions->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });;

        $product = Product::where('user_id', Auth::user()->id)->count();

        return view('pages.front.dashboard',[
            'transactionCount' => $transactions->count(),
            'sellTransaction' => $transactions->paginate(5),
            'revenue' => $revenue,
            'product' => $product
        ]);
    }
}
