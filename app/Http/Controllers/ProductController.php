<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCount = DB::table('order_product')
        ->join('orders', 'order_product.order_id', '=', 'orders.id')
        ->where('orders.user_id', auth()->id()) 
        ->where('orders.status', 'pending')
        ->sum('order_product.quantity'); 

        $products = Product::with(['images' => function ($query) {
            $query->inRandomOrder()->take(1);
        }])->get();
    
        foreach ($products as $product) {
            $product->image = $product->images->first();
        }
    
        return view('pages.products', compact('products', 'productCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->back()->withInput()->with('success', 'Flower added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productCount = DB::table('order_product')
        ->join('orders', 'order_product.order_id', '=', 'orders.id')
        ->where('orders.user_id', auth()->id()) 
        ->where('orders.status', 'pending')
        ->sum('order_product.quantity'); 

        $product = Product::with('images', 'category')->find($product->id);
        
        //dd($product);
        return view('pages.productDetails', compact('product','productCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); 

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->hasFile('images')) {
            $product->images()->delete();

            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->back()->withInput()->with('success', 'Flower updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            $product->delete();

            return redirect()->back()->with('success', 'pro$product and associated images deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting pro$product: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while deleting the pro$product. Please try again.');
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        try {
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->with(['images' => function($query) {
                    $query->select('id', 'imageable_id', 'path');
                }])
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'category_id' => $product->category_id,
                        'images' => $product->images->pluck('path'),
                    ];
                });
    
            return response()->json($products);
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to process request'], 500);
        }
    }



}
