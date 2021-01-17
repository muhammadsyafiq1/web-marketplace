<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Resources\ProductCollection as ProductCollectionResource;

class ProductController extends Controller
{
    public function index()
    {
        $criteria = Product::with(['gallery','productvariant'])
        ->orderBy('id', 'DESC')
        ->paginate(32);
        if($criteria)
            return ResponseFormatter::success($criteria, 'Data berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data tidak berhasil diambil', 404); 
    }

    public function slug($slug)
    {
        $criteria = Product::with(['gallery','productvariant'])
        ->where('slug', $slug)
        ->firstOrFail();
        if($criteria)
            return ResponseFormatter::success($criteria, 'Data berhasil diambil');
        else
            return ResponseFormatter::error('null','Data tidak tersedia', 404);
        
    }

    public function random($count)
    {
        $criteria = Product::with(['gallery','productvariant'])
        ->inRandomOrder()
        ->limit($count)
        ->get();

        return new ProductCollectionResource($criteria);
    }

    public function mostPicked()
    {
        $criteria = Product::with(['gallery','productvariant'])
        ->where('sold_out', '>' , 0)
        ->orderBy('sold_out', 'DESC')
        ->limit(4)
        ->get();

        return new ProductCollectionResource($criteria);
    }
}
