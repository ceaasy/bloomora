<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('pages.catalog.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.catalog.show', compact('product'));
    }
}