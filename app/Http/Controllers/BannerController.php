<?php

namespace App\Http\Controllers;

use App\Models\Bann;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
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
            $query = Bann::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <form action="'. route('banner.destroy',$item->id) .'" method="POST" >
                        '. method_field('DELETE') . csrf_field() .'
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm("Are you Sure?")">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->editColumn('banner', function($item){
                return $item->banner ? '<img src="'.Storage::url($item->banner).'" style="max-height: 100px;"/>' : '';
            })
            ->rawColumns(['action','banner'])
            ->make();
        }
        return view('pages.admin.banner.index');
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
        $data = $request->all();
        $data['banner'] = $request->file('banner')->store('banner','public');
        Bann::create($data);
        return redirect(route('banner.index'))->with('info','banner berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        $item = Bann::find($id);
        $item->delete();
        return redirect(route('banner.index'))->with('info','Banner berhasil dihapus');
    }
}
