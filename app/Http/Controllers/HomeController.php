<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('home', compact('products', 'galleries'));
    }
}
