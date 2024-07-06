@extends('layouts')

@section('content')

    <!-- Hero Section with Search -->
    <header class="bg-gradient-to-br from-green-300 via-green-400 to-green-600 text-white py-24">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 text-shadow-lg">Green Oasis Florist</h1>
            <p class="text-xl mb-10 font-light">Nature's beauty, delivered to your doorstep</p>
            <div class="max-w-2xl mx-auto">
                <form class="flex shadow-lg rounded-full overflow-hidden">
                    <input type="text" placeholder="Search for your perfect bouquet..." class="flex-grow px-6 py-4 focus:outline-none text-gray-800 text-lg">
                    <button type="submit" class="bg-black px-8 py-4 hover:bg-gray-800 transition duration-300">
                        <i class="fas fa-search text-xl text-white"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Product Grid -->
    <main class="container mx-auto px-4 py-20">
        <h2 class="text-4xl font-bold text-center text-green-700 mb-12">Our Signature Collections</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Product Card Template -->
            @foreach(['Emerald Rose Elegance', 'Verdant Daisy Delight', 'Tropical Green Orchid', 'Forest Wildflower Blend'] as $index => $product)
                <a href="{{ url('productDetails') }}" class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <img src="https://asset.bloomnation.com/ar_252:252,c_fill,d_vendor:global:catalog:product:image.png,f_auto,fl_preserve_transparency,q_auto,w_1200/v1719872360/vendor/7591/catalog/product/2/0/20240123055455_file_65affd6f34df8_65b005acda09c.jpg" 
                            alt="{{ $product }}" 
                            class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-green-800 mb-3">{{ $product }}</h3>
                        <p class="text-gray-600 mb-4">A lush arrangement to bring nature indoors</p>
                        <div class="flex justify-between items-center">
                            <span class="text-3xl font-bold text-green-600">${{ 39.99 + ($index * 10) }}</span>
                            <button class="bg-black text-white px-6 py-3 rounded-full hover:bg-green-800 transition duration-300 transform hover:scale-105">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </main>

    <!-- Feature Section -->
    <section class="bg-green-50 py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-black mb-12">The Green Oasis Difference</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center">
                    <i class="fas fa-leaf text-5xl text-green-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold mb-2">Eco-Friendly</h3>
                    <p class="text-gray-700">Sustainable practices in every bouquet</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-truck text-5xl text-green-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold mb-2">Same-Day Delivery</h3>
                    <p class="text-gray-700">Fresh flowers, right when you need them</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-heart text-5xl text-green-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold mb-2">Happiness Guaranteed</h3>
                    <p class="text-gray-700">Love your flowers or we'll make it right</p>
                </div>
            </div>
        </div>
    </section>

@endsection