<?php

namespace App\Http\Controllers;

use App\Models\Bann;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comentar;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Bann::all();
        $products = Product::with(['gallery','productvariant'])
            ->whereHas('gallery')
            ->whereHas('productvariant')
            ->orderBy('id', 'desc')
            ->paginate(28);
        $product_demands = Product::with(['gallery','productvariant'])
            ->whereHas('productvariant')
            ->whereHas('gallery')
            ->where('sold_out', '>' , 0)
            ->orderBy('sold_out', 'DESC')
            ->limit(8)
            ->get();
            
        
        $categories = Category::all();
        
        return view('pages.front.index', compact([
            'categories','products','product_demands','banners'
        ]));
    }

    public function detail($id)
    {
        $product = Product::with(['gallery','productvariant'])
        ->where('slug', $id)
        ->firstOrFail();

        $comentars = Comentar::with('user','product')->where('product_id', $product->id)
        ->get();
        return view('pages.front.detail', compact('product','comentars'));
    }

    public function addToCart(Request $request)
    {
        $carts = Cart::create([
            'user_id' => Auth::user()->id,
            'product_variant_id' => $request->product_variant_id,
            'product_id' => $request->product_id,
        ]);
        // kurangi stock
        $stock = ProductVariant::where('id', $carts->product_variant_id )->first();
        $stock->decrement('stock');

        return redirect(route('cart'));
    }

    public function shoppingHistory ()
    {
        $sellTransaction = TransactionDetail::with(['transaction.user','product.gallery'])->whereHas('product', function($product){
            $product->where('user_id', Auth::user()->id);
        })->get();
            
        $buyTransaction = TransactionDetail::with(['transaction.user','product.gallery'])->whereHas('transaction', function($transaction){
            $transaction->where('user_id', Auth::user()->id);
        })->get();

        return view('pages.front.shopping-history',compact('sellTransaction','buyTransaction'));
    }
}
