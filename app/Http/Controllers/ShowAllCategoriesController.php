<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowAllCategoriesController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Categories', [
            'categories' => Category::withCount('products')->get()
        ]);
    }
}
