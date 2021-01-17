<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['gallery','productvariant'])
            ->whereHas('productvariant')
            ->whereHas('gallery')
            ->get();
        return view('pages.front.categories', compact([
            'categories','products'
        ]));
    }

    public function productByCategory($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $products = Product::with(['gallery','productvariant'])
            ->whereHas('productvariant')
            ->whereHas('gallery')
            ->where('category_id', $category->id)
            ->get();
        return view('pages.front.categories', compact([
            'products','categories'
        ]));
    }
}
