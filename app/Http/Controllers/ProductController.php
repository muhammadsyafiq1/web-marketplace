<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Product::with(['user','category']);
            return DataTables::of($query)

            ->addColumn('action', function($item){
                return '
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <form action="'. route('product.destroy',$item->id) .'" class="d-inline" method="POST">
                            '. method_field('DELETE') . csrf_field() . '
                                <a class="dropdown-item btn btn-sm btn-secondary" href="'. route('product.show',$item->id) .'">Detail</a>
                                <a class="dropdown-item btn btn-sm btn-warning" href="'. route('product.edit',$item->id) .'">Edit</a>
                                <a class="dropdown-item btn btn-sm btn-warning" href="'. route('product-variant',$item->id) .'">Add Variant</a>
                                <div class="dropdown-divider"></div>
                                <button type="submit" class="btn btn-block btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action','index'])
            ->make();
        }
        $categories = Category::all();
        return view('pages.admin.products.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data['user_id'] = $request->user_id;
        Product::create($data);
        return redirect(route('product.index'))->with('info','Product has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('pages.admin.products.edit', compact('categories','product'));
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
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = $request->user_id;
        $item = Product::findOrFail($id);
        $item->update($data);
        return redirect(route('product.index'))->with('info','Product successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect(route('product.index'))->with('info','Product has been Created');
    }
}
