<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function($q) use ($request) {
            return $q->where('name', 'like' , '%' . $request->search . '%')
            ->orWhere('phone', 'like' , '%' . $request->search . '%')
            ->orWhere('address', 'like' , '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|unique:clients,phone',
            'address' => 'required'
        ]);

        Client::create($request->except('_token'));
        return redirect()->route('clients.index')->with(['success', 'The Client Added Successfully']);
    }

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|unique:clients,phone',
            'address' => 'required'
        ]);

        $client->update($request->except('_token'));
        return redirect()->route('clients.index')->with(['success', 'The Client Updated Successfully']);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with(['success' => 'The Category Deleted Successfully']);
    }
}
