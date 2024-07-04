<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class dashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $flowers = Product::with('category')->get();
        return view('pages.dashboard', compact('categories','flowers'));
    }

}
