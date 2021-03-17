<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client', 'categories', 'orders'));
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        // Attach Order
        $this->attach_order($request, $client);
        return redirect()->route('orders.index')->with(['success' => 'The Order Added Successfully']);
    }

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('client', 'categories', 'order', 'orders'));
    }

    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        // dettach old order
        $this->dettach_order($order);

        // Attach Order
        $this->attach_order($request, $client);

        return redirect()->route('orders.index')->with(['success' => 'The Order Updated Successfully']);
    }

    public function destroy(Client $client, Order $oreder)
    {
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;

        foreach ($request->products as $id => $quantity) {
            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];
            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);
        }

        $order->update([
            'total_price' => $total_price
        ]);
    }

    private function dettach_order($order)
    {
        // reset the number of products in the stock
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }

}
