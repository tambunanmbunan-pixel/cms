<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    public function index()
    {
        Session::put('page', 'shipments'); // Tambahkan ini
        $shippings = Shipping::orderBy('id', 'desc')->get();
        return view('admin.shippings.index', compact('shippings'));
    }

    public function create()
    {
        return view('admin.shippings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'courier_name' => 'required|string|max:255',
            'service_name' => 'required|string|max:255',
            'cost'         => 'required|numeric|min:0',
            'estimated_time'=> 'required|string|max:255',
        ]);

        Shipping::create([
            'courier_name'  => $request->courier_name,
            'service_name'  => $request->service_name,
            'cost'          => $request->cost,
            'estimated_time'=> $request->estimated_time,
            'status'        => 'active',
        ]);

        return redirect()->route('shippings.index')->with('success_message', 'Opsi pengiriman berhasil ditambahkan ke Oracle!');
    }

    public function show($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shippings.show', compact('shipping'));
    }

    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shippings.edit', compact('shipping'));
    }

    public function update(Request $request, $id)
    {
        $shipping = Shipping::findOrFail($id);

        $request->validate([
            'courier_name' => 'required|string|max:255',
            'service_name' => 'required|string|max:255',
            'cost'         => 'required|numeric|min:0',
            'estimated_time'=> 'required|string|max:255',
            'status'       => 'required|in:active,inactive',
        ]);

        $shipping->update($request->all());

        return redirect()->route('shippings.index')->with('success_message', 'Data pengiriman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();

        return redirect()->route('shippings.index')->with('success_message', 'Opsi pengiriman berhasil dihapus permanen!');
    }
}