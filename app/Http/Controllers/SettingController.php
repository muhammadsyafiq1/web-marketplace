<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function storeSetting()
    {
        $user  = Auth::user();
        $categories = Category::all();
        return view('pages.front.store-setting', compact('user','categories'));
    }

    public function storeUpdate(Request $request)
    {
        $request->validate([
            'store_name' => 'string'
        ]);
        $data = $request->all();
        $item = Auth::user();
        $item->update($data);
        return redirect()->back()->with('info','Settingan Store Berhasil DIubah.');
    }

    public function account()
    {
        $user = Auth::user();
        return view('pages.front.account', compact('user'));
    }
}
