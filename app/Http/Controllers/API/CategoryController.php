<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\API\ResponseFormatter;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $criteria = Category::paginate(6);
        if($criteria)
            return ResponseFormatter::success($criteria, 'Data berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data tidak berhasil diambil', 404); 
    }

    public function productByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if(empty($category->slug)){
            return ResponseFormatter::error(null, 'Category tidak ada', 404); 
        }

        $products = Product::with(['gallery','productvariant'])
            ->where('category_id', $category->id)
            ->get(); 
        if($products)
            return ResponseFormatter::success($products, 'Data berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data tidak berhasil diambil', 404); 
    }
}

