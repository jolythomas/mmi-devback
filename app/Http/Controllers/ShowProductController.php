<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ShowProductController extends Controller
{
    public function __invoke(Product $product)
    {
        // Charger le produit avec sa catégorie
        $product->load('category');
        
        // Récupérer des produits similaires de la même catégorie
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return Inertia::render('Products/Show', [
            'product' => $product,
            'similarProducts' => $similarProducts
        ]);
    }
} 