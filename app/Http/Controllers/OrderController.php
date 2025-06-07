<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client', 'items.product'])->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('orders.create', compact('clients', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
            'city_ref' => 'required|string',
            'warehouse_ref' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $total = 0;

        $order = Order::create([
            'client_id' => $request->client_id,
            'city_ref' => $request->city_ref,
            'warehouse_ref' => $request->warehouse_ref,
            'note' => $request->note,
            'total' => 0,
        ]);

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            $qty = $productData['qty'];
            $subtotal = $qty * $product->price;
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }

        $order->update(['total' => $total]);

        return redirect()->route('orders.index')->with('success', 'Замовлення створено успішно.');
    }

    public function show(Order $order)
    {
        $order->load(['client', 'items.product']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();
        $order->load(['items']);
        return view('orders.edit', compact('order', 'clients', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
            'city_ref' => 'required|string',
            'warehouse_ref' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $order->update([
            'client_id' => $request->client_id,
            'note' => $request->note,
            'city_ref' => $request->city_ref,
            'warehouse_ref' => $request->warehouse_ref,
        ]);

        $order->items()->delete();

        $total = 0;

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            $qty = $productData['qty'];
            $subtotal = $qty * $product->price;
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }

        $order->update(['total' => $total]);

        return redirect()->route('orders.index')->with('success', 'Замовлення оновлено.');
    }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Замовлення видалено.');
    }
}

