<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ShowCartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->user()->cart()->first();
        $cartItems = [];

        if ($cart) {
            $cartItems = $cart->items()->with('product')->get();
        }

        return Inertia::render('Cart/Index', [
            'cartItems' => $cartItems
        ]);
    }

    public function removeItem(Request $request, CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Produit retiré du panier');
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$cartItem->product->stock
        ]);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back();
    }
} 