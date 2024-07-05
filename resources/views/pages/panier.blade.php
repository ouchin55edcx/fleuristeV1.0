@extends('layouts')

@section('content')
    <div class="bg-green-50 min-h-screen py-12">
        <div class="container mx-auto px-4 mt-12">
            <h1 class="text-3xl font-bold text-green-800 mb-8">Your Shopping Cart</h1>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="p-6 mt-12">

                    <!-- Cart Cards -->
                    @if ($orders->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <div class="flex items-center py-6">
                                    <img src="{{ $order->image_url ?? '#' }}" alt="{{ $order->name }}"
                                        class="w-24 h-24 object-cover rounded-md">
                                    <div class="ml-4 flex-grow">
                                        <h3 class="text-lg font-semibold text-green-800">{{ $order->name }}</h3>
                                        <!-- Assuming description is available in product details -->
                                    </div>
                                    <div class="flex items-center">
                                        <button class="text-gray-500 hover:text-green-500 focus:outline-none"
                                            onclick="updateQuantity('{{ $order->product_id }}', 'minus')">
                                            <i class="fas fa-minus-circle"></i>
                                        </button>
                                        <span id="quantity_{{ $order->product_id }}"
                                            class="mx-2 w-8 text-center">{{ $order->total_quantity }}</span>
                                        <button class="text-gray-500 hover:text-green-500 focus:outline-none"
                                            onclick="updateQuantity('{{ $order->product_id }}', 'plus')">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                    </div>
                                    <span class="ml-4 text-lg font-semibold text-green-600">${{ $order->price }}</span>
                                    <button class="ml-4 text-red-500 hover:text-red-700 focus:outline-none">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cart Summary -->
                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-lg text-gray-600">Subtotal</span>
                                <span class="text-lg font-semibold text-green-600">
                                    ${{ $orders->sum(function ($order) {return $order->price * $order->total_quantity;}) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-lg text-gray-600">Shipping</span>
                                <span class="text-lg font-semibold text-green-600">$10.00</span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-xl font-bold text-gray-800">Total</span>
                                <span class="text-xl font-bold text-green-600">
                                    ${{ $orders->sum(function ($order) {return $order->price * $order->total_quantity;}) + 10 }}
                                </span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <div class="mt-8">
                            <button id="checkoutBtn"
                                class="w-full bg-green-600 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-green-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
                                onclick="checkout()">
                                Proceed to Checkout
                            </button>
                        </div>
                    @else
                        <p class="text-gray-600 text-center">Your cart is empty. <a href="{{ url('products') }}"
                                class="text-green-600 hover:text-green-800 transition duration-300">Continue Shopping</a>
                        </p>
                    @endif

                    <!-- Continue Shopping Link -->
                    <div class="mt-4 text-center">
                        <a href="{{ url('products') }}"
                            class="text-green-600 hover:text-green-800 transition duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
