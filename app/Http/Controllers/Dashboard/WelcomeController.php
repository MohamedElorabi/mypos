<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;



class WelcomeController extends Controller
{
    public function index()
    {
        $categories_count = Category::count();
        $orders_count = Product::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();

        return view('dashboard.welcome', compact('categories_count', 'orders_count', 'products_count', 'clients_count', 'users_count'));
    }
}
