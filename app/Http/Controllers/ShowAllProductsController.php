<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowAllProductsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Products', [
            'products' => Product::with('category')->get(),
            'categories' => Category::all()
        ]);
    }
}
