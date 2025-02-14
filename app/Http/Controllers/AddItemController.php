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
    public function __invoke(Request $request, Product $product)
    {
        {
            $request->validate([
                'quantity' => 'required|integer|min:1|max:'.$product->stock
            ]);

            $cart = $request->user()->cart()->firstOrCreate();
            
            $cartItem = $cart->items()->where('product_id', $product->id)->first();
            
            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $request->quantity
                ]);
            } else {
               $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'price' => $product->price
                ]);
            }

            return redirect()->back()->with('success', 'Produit ajouté au panier');
            
        }
    }
}
