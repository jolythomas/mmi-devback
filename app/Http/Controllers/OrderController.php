<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function checkout()
    {
        $cart = request()->user()->cart()->first();
        $cartItems = [];
        $total = 0;

        if ($cart) {
            $cartItems = $cart->items()->with('product')->get();
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }
        }

        $addresses = Address::where('user_id', Auth::id())->get()->map(function ($address) {
            return [
                'id' => $address->id,
                'address' => $address->street,
                'city' => $address->city,
                'postal_code' => $address->postal_code,
                'country' => $address->country,
                'is_default' => $address->is_default
            ];
        });

        return Inertia::render('Checkout', [
            'total' => $total,
            'addresses' => $addresses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'use_existing_address' => 'required|boolean',
            'address_id' => 'required_if:use_existing_address,true|exists:addresses,id',
            'address' => 'required_if:use_existing_address,false|string',
            'city' => 'required_if:use_existing_address,false|string',
            'postal_code' => 'required_if:use_existing_address,false|string',
            'country' => 'required_if:use_existing_address,false|string',
        ]);

        $cart = request()->user()->cart()->first();
        $cartItems = [];
        $total = 0;

        if ($cart) {
            $cartItems = $cart->items()->with('product')->get();
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }
        }

        if ($request->use_existing_address) {
            $address = Address::findOrFail($request->address_id);
            $orderData = [
                'user_id' => Auth::id(),
                'address' => $address->street,
                'city' => $address->city,
                'postal_code' => $address->postal_code,
                'country' => $address->country,
                'total_amount' => $total,
                'status' => 'pending'
            ];
        } else {
            $orderData = [
                'user_id' => Auth::id(),
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'total_amount' => $total,
                'status' => 'pending'
            ];
        }

        $order = Order::create($orderData);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Supprimer le panier après la commande
        if ($cart) {
            $cart->items()->delete();
            $cart->delete();
        }

        return Inertia::render('OrderConfirmation', [
            'order' => $order->load('items.product')
        ]);
    }

    public function show(Order $order)
    {
        return Inertia::render('OrderConfirmation', [
            'order' => $order->load('items.product')
        ]);
    }
}
