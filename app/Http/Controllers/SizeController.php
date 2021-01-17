<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
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
            $query = Size::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <form action="'. route('size.destroy',$item->id) .'" method="POST" >
                        '. method_field('DELETE') . csrf_field() .'
                        <a href="'. route('size.show',$item->id) .'" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="'. route('size.edit',$item->id) .'" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm("Are you Sure?")">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action','index'])
            ->make();
        }
        return view('pages.admin.sizes.index');
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100'
        ]);

        $data = $request->all();
        Size::create($data);
        return redirect(route('size.index'))->with('info','Size has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::findOrFail($id);
        return view('pages.admin.sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('pages.admin.sizes.edit', compact('size'));
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
        $item = Size::findOrFail($id);
        $item->update($data);
        return redirect(route('size.index'))->with('info','Size has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect(route('size.index'))->with('info','Size has been Deleted');
    }
}
