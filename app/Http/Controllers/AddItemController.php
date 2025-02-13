<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AddItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1|max:'.$product->stock]
        ]);

        $cart = $request->user()->customer->cart()->firstOrCreate();
    }
}
