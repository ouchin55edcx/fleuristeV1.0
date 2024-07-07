<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        
        $userId = Auth::id();
        Log::info('Creating order for user ID: ' . $userId);
    
        if (!$userId) {
            return redirect()->back()->with('error', 'You must be logged in to place an order.');
        }
    
        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending',
            'total' => $product->price * $quantity,
        ]);
    
        $order->products()->attach($product->id, [
            'quantity' => $quantity,
            'price' => $product->price,
        ]);
    
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function showPanier()
    {
        $orders = DB::table('orders')
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->select(
                'products.id as product_id',
                'products.name', 
                'products.price', 
                DB::raw('SUM(order_product.quantity) as total_quantity')
            )
            ->where('orders.status', 'pending')
            ->where('orders.user_id', Auth::id())
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderBy('products.name') 
            ->get();
    
        return view('pages.panier', compact('orders'));
    }


    public function updateQuantity(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');
        $userId = Auth::id();
    
        try {
            DB::table('order_product')
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->where('orders.user_id', $userId)
                ->where('orders.status', 'pending')
                ->where('order_product.product_id', $productId)
                ->update(['order_product.quantity' => $quantity]);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error updating quantity: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    public function checkout()
    {
        $userId = Auth::id();
    
        try {
            DB::transaction(function () use ($userId) {
                Order::where('user_id', $userId)
                    ->where('status', 'pending')
                    ->update(['status' => 'completed']);
            });
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error during checkout: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }


    
    
    

}
