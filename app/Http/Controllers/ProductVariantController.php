<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVariantRequest;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductVariantController extends Controller
{
    public function index($id)
    {
        $product = Product::with('gallery')->find($id);
        $colors = Color::all();
        $sizes = Size::all();

        if(request()->ajax())
        {
            $query = ProductVariant::with(['size','color'])->where('product_id', $id);
            return DataTables::of($query)

            ->addColumn('action', function($item){
                return '
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item btn  btn=block btn-sm btn-danger" href="'. route('product-variant.delete',$item->id) .'">Delete</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action','index'])
            ->make();
        }
        return view('pages.admin.variants.index', compact([
            'sizes','colors','product'
        ]));
    }

    public function store(CreateVariantRequest $request)
    {
        $data = $request->all();
        dd($data);
        $data['product_id'] = $request->product_id;
        ProductVariant::create($data);
        return redirect()->back()->with('info','Variant product berhasil dibuat');
    }

    public function delete($id)
    {
        $variant = ProductVariant::find($id);
        $variant->delete();
        return redirect()->back()->with('info','Variant berhasil dihapus');
    }

    public function deleteImage($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->back()->with('info','Image berhasil dihapus');
    }
}
