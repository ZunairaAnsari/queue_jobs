<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->take(8)->get();
        $categories = Category::all();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
