<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
            $query = User::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <form action="'. route('user.destroy',$item->id) .'" method="POST" >
                        '. method_field('DELETE') . csrf_field() .'
                        <a href="'. route('user.show',$item->id) .'" class="btn btn-sm btn-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="'. route('user.edit',$item->id) .'" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm("Are you Sure?")">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->editColumn('avatar', function($item){
                return $item->avatar ? '<img src="'.Storage::url($item->avatar).'" style="max-height: 40px;"/>' : '';
            })
            ->rawColumns(['action','index'])
            ->make();
        }
        return view('pages.admin.users.index');
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
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $data['password'] = Hash::make($request->password);
        $data['avatar'] = $request->file('avatar')->store('avatars','public');
        $data['roles'] = $request->roles;
        User::create($data);
        return redirect()->route('user.index')->with('info','User has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        if($request->hasFile('avatar')){
            if($request->avatar && file_exists(storage_path('app/public/',$request->avatar))){
                Storage::delete('public/',$request->avatar);
            }
            $file = $request->file('avatar')->store('avatars','public');
            $data['avatar'] = $file;
        }
        $item = User::findOrFail($id);
        $item->update($data);

        return redirect(route('user.index'))->with('info','User has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('user.index'))->with('info','User has been Deleted');
    }
}
