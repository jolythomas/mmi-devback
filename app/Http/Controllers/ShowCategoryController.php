<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class ShowCategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        $category->load('products');

        return Inertia::render('Categories/Show', [
            'category' => $category,
            'products' => $category->products()->with('category')->get()
        ]);
    }
} 