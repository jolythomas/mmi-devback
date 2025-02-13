<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AddItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product)
    {
        {
            $request->validate([
                'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock]
            ]);

            // Créer ou récupérer le panier de l'utilisateur
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);
            
            // Vérifier si le produit existe déjà dans le panier
            $cartItem = CartItem::where('cart_id', $cart->id)
                              ->where('product_id', $product->id)
                              ->first();
            
            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $request->quantity
                ]);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'price' => $product->price
                ]);
            }

            return redirect()->back()->with('success', 'Produit ajouté au panier');
            
        }
    }
}
