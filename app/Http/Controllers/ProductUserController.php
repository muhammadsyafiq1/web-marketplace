<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\CreateVariantRequest;

class ProductUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['gallery','user','category'])
        ->whereHas('gallery')
        ->where('user_id', Auth::user()->id)
        ->paginate(12);

        return view('pages.front.product-user', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.front.create-product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth::user()->id;
        $product = Product::create($data);

        $gallery = ([
            'product_id' => $product->id,
            'image' => $request->file('image')->store('image_products','public'),
        ]);
        Gallery::create($gallery); 

        return redirect(route('products.index'))
        ->with('info','Anda bisa memberikan properti pada product anda');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('pages.front.product-user-detail', compact([
            'product','categories','sizes','colors'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeImage($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->back()->with('info','Gallery berhasil dihapus');
    }

    public function addVariant(CreateVariantRequest $request)
    {
        $data = $request->all();
        ProductVariant::create($data);
        return redirect()->back()->with('info', 'variant berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('products.index'))->with('info','Product berhasil Dihapus');
    }

}
