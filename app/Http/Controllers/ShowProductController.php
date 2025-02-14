<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ShowProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load('category');
        
        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }
} 