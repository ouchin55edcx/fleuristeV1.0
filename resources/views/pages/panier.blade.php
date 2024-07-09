@extends('layouts')

@section('content')
    <div class="bg-green-50 min-h-screen py-12">
        <div class="container mx-auto px-4 mt-12">
            <h1 class="text-3xl font-bold text-green-800 mb-8">Your Shopping Cart</h1>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="p-6 mt-12">

                    @if ($orders->count() > 0)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Cart Items -->
                        <div class="divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <div class="p-6 flex flex-col sm:flex-row items-center justify-between">
                                    <div class="flex-grow mb-4 sm:mb-0">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $order->name }}</h3>
                                        <p class="text-sm text-gray-500">Product ID: {{ $order->product_id }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center border rounded-full bg-gray-100">
                                            <button class="px-3 py-1 text-gray-600 hover:text-gray-800 focus:outline-none" 
                                                    onclick="updateQuantity('{{ $order->product_id }}', 'minus')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <span id="quantity_{{ $order->product_id }}" 
                                                  class="px-3 py-1 text-center min-w-[40px]">
                                                {{ $order->total_quantity }}
                                            </span>
                                            <button class="px-3 py-1 text-gray-600 hover:text-gray-800 focus:outline-none" 
                                                    onclick="updateQuantity('{{ $order->product_id }}', 'plus')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        <span class="text-lg font-semibold text-indigo-600">${{ number_format($order->price, 2) }}</span>
                                        <button class="text-red-500 hover:text-red-700 focus:outline-none transition duration-150 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                
                        <!-- Cart Summary -->
                        <div class="bg-gray-50 p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-lg font-semibold text-gray-800">
                                        ${{ number_format($orders->sum(function ($order) {return $order->price * $order->total_quantity;}), 2) }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="text-lg font-semibold text-gray-800">$10.00</span>
                                </div>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                    <span class="text-xl font-bold text-gray-800">Total</span>
                                    <span class="text-xl font-bold text-indigo-600">
                                        ${{ number_format($orders->sum(function ($order) {return $order->price * $order->total_quantity;}) + 10, 2) }}
                                    </span>
                                </div>
                            </div>
                
                            <!-- Checkout Button -->
                            <div class="mt-8">
                                <button id="checkoutBtn"
                                    class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50"
                                    onclick="checkout()">
                                    Proceed to Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                        <p class="text-gray-600 mb-4">Your cart is empty.</p>
                        <a href="{{ url('products') }}" 
                           class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
                            Start Shopping
                        </a>
                    </div>
                @endif
    <script>
        // Function to update quantity via AJAX
        function updateQuantity(productId, action) {
            let quantityElement = document.getElementById('quantity_' + productId);
            let currentQuantity = parseInt(quantityElement.textContent);

            // Adjust quantity based on action
            if (action === 'plus') {
                currentQuantity++;
            } else if (action === 'minus' && currentQuantity > 1) {
                currentQuantity--;
            }

            // Perform AJAX request to update quantity in backend
            fetch('/update-quantity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: currentQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the quantity display
                        quantityElement.textContent = currentQuantity;
                        // Update total price (you may need to add more logic here)
                    } else {
                        alert('Failed to update quantity. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });


        }

        function checkout() {
            fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Checkout successful! Your order has been placed.');
                        // Redirect to a confirmation page or refresh the current page
                        window.location.reload();
                    } else {
                        alert('Checkout failed. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during checkout. Please try again.');
                });
        }
    </script>
@endsection
