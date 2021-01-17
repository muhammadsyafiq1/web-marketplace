<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
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
            $query = Category::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <form action="'. route('category.destroy',$item->id) .'" method="POST" >
                        '. method_field('DELETE') . csrf_field() .'
                        <a href="'. route('category.show',$item->id) .'" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="'. route('category.edit',$item->id) .'" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onClick="return confirm("Are you Sure?")">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->editColumn('photo', function($item){
                return $item->photo ? '<img src="'.Storage::url($item->photo).'" style="max-height: 40px;"/>' : '';
            })
            ->rawColumns(['action','photo'])
            ->make();
        }
        return view('pages.admin.categories.index');
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
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('categories','public');
        Category::create($data);
        return redirect(route('category.index'))->with('info','Category has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.admin.categories.edit', compact('category'));
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
        if($request->hasFile('photo')){
            if($request->photo && file_exists(storage_path('app/public/',$request->photo))){
                Storage::delete('public/',$request->photo);
            }
            $file = $request->file('photo')->store('categories','public');
            $data['photo'] = $file;
        }
        $item = Category::findOrFail($id);
        $item->update($data);
        return redirect(route('category.index'))->with('info','Category has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect(route('category.index'))->with('info','Category has been Deleted');
    }
}
