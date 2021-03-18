<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::whereRoleIs('admin')->count();
        $clients_count = Client::count();
        $categories_count = Category::count();
        $products_count = Product::count();

        $sales_data = Order::select([
            DB::raw('Year(created_at) as year'),
            DB::raw('Month(created_at) as month'),
            DB::raw('Sum(total_price) as sum'),
        ])->groupBy('month')->get();


        return view('dashboard.index',compact('users_count', 'clients_count', 'categories_count', 'products_count', 'sales_data'));
    }
}
