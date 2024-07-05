<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

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
    

}
