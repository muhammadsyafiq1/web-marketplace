<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('roles', 'customer')->count();
        $products = Product::count();
        $categories = Category::count();
        $money = Transaction::sum('total_price');
        $pie = [
            'pending' => Transaction::where('transaction_status','pending')->count(),
            'success' => Transaction::where('transaction_status','success')->count(),
            'failure' => Transaction::where('transaction_status','failure')->count()
        ];

        
        return view('pages.admin.index', [
            'users' => $users,
            'products' => $products,
            'money' => $money,
            'pie' => $pie,
            'categories' => $categories
        ]);
    }
}
