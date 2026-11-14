<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(12);

        return view('galleries.index', compact('galleries'));
    }
}
