@extends('layouts')


@section('content')
<!-- Cart Icon -->
<div class="fixed top-4 right-16 z-50">
    <div class="relative">
        <a href="{{ url('panier') }}" class="block">
            <i class="fas fa-shopping-cart text-2xl text-green-600 hover:text-green-700 transition-colors duration-300"></i>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                {{ $productCount }}
            </span>
        </a>
    </div>
</div>
    <!-- Hero Section with Search -->
    <header class="bg-gradient-to-br from-green-300 via-green-400 to-green-600 text-white py-24">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 text-shadow-lg">Green Oasis Florist</h1>
            <p class="text-xl mb-10 font-light">Nature's beauty, delivered to your doorstep</p>
            <div class="max-w-2xl mx-auto">
                <form id="searchForm" class="flex shadow-lg rounded-full overflow-hidden">
                    <input type="text" id="searchInput" placeholder="Search for your perfect bouquet..."
                        class="flex-grow px-6 py-4 focus:outline-none text-gray-800 text-lg">
                </form>
            </div>
        </div>
    </header>

    <!-- Search Results -->
    <div id="searchResults" class="container mx-auto px-4 py-10 hidden">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Search Results</h2>
        <div id="searchResultsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Search results will be inserted here -->
        </div>
    </div>

    <!-- Product Grid -->
    <main id="productGrid" class="container mx-auto px-4 py-20">
        <h2 class="text-4xl font-bold text-center text-green-700 mb-12">Our Signature Collections</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div
                    class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image->path) }}" alt="{{ $product->name }}"
                            class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition duration-300">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-green-800 mb-3">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-3xl font-bold text-green-600">${{ $product->price }}</span>
                            <a href="{{ route('products.show', $product->id) }}"
                                class="bg-black text-white px-6 py-3 rounded-full hover:bg-green-800 transition duration-300 transform hover:scale-105">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>


    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            searchProducts();
        });
    
        function searchProducts() {
            const query = document.getElementById('searchInput').value;
    
            const searchResults = document.getElementById('searchResults');
            const searchResultsGrid = document.getElementById('searchResultsGrid');
            const productGrid = document.getElementById('productGrid');
    
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(products => {
                    searchResultsGrid.innerHTML = '';
                    if (products.length > 0) {
                        products.forEach(product => {
                            const imagePath = product.images && product.images.length > 0 
                                ? '/storage/' + product.images[0] 
                                : '#'; 
                                
                            searchResultsGrid.innerHTML += `
                        <div class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                            <div class="relative overflow-hidden">
                                <img src="${imagePath}"
                                    alt="${product.name}"
                                    class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition duration-300">
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-semibold text-green-800 mb-3">${product.name}</h3>
                                <p class="text-gray-600 mb-4">${product.description}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-3xl font-bold text-green-600">$${product.price}</span>
                                    <a href="/products/${product.id}"
                                        class="bg-black text-white px-6 py-3 rounded-full hover:bg-green-800 transition duration-300 transform hover:scale-105">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                        });
                        searchResults.classList.remove('hidden');
                        productGrid.classList.add('hidden');
                    } else {
                        searchResultsGrid.innerHTML = '<p class="text-center text-gray-600">No products found.</p>';
                        searchResults.classList.remove('hidden');
                        productGrid.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    searchResultsGrid.innerHTML =
                        '<p class="text-center text-red-600">An error occurred while searching. Please try again.</p>';
                });
        }
    </script>
@endsection
