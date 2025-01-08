<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::paginate($request->input('limit', 12));

        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with('galleries')->where('categories_id', $category->id)->paginate();

        return view('pages.category',[
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
        ]);
    }
}
