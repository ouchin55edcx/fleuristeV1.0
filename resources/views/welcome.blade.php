@extends('layouts')

@section('content')
    <!-- Hero Section -->
    <div class="flex flex-wrap items-center bg-gradient-to-r from-green-50 to-green-100">
        <div class="w-full  lg:w-1/2 p-8 lg:p-16">
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-800 leading-tight mt-12">
                Find your <span class="text-green-600">greeny</span> companion for your space
            </h1>
            <div class="w-20 h-2 bg-green-600 mb-8"></div>
            <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                Discover the perfect plant to breathe life into your room. Our curated selection of green companions will
                transform your space into a natural haven.
            </p>
            <a href="#"
                class="inline-block bg-green-600 text-white text-lg font-semibold px-8 py-4 rounded-full hover:bg-green-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                Explore Collection
            </a>
        </div>
        <div class="w-full lg:w-1/2 h-96 lg:h-screen">
            <img src="https://images.unsplash.com/photo-1536147116438-62679a5e01f2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                alt="Leafy plants" class="w-full h-full object-cover">
        </div>
    </div>

<!-- Categories Section -->
<section class="bg-gradient-to-b from-gray-50 to-white py-20 px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto">
        <h2 class="text-5xl font-extrabold text-center text-gray-800 mb-16 relative">
            Explore Our Categories
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-green-500 rounded-full"></span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach ($categories as $category)
                <div class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 ease-in-out transform hover:-translate-y-2">
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image->path) }}" alt="{{ $category->name }}"
                            class="w-full h-80 object-cover group-hover:scale-110 transition duration-500 ease-in-out">
                    @else
                        <div class="w-full h-80 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400 text-4xl"><i class="fas fa-image"></i></span>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70 group-hover:opacity-90 transition duration-500 ease-in-out"></div>
                    
                    <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-6 group-hover:translate-y-0 transition duration-500 ease-in-out">
                        <h3 class="text-white text-3xl font-bold mb-2 group-hover:text-4xl transition-all duration-500 ease-in-out">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out">
                            Discover amazing products in this category
                        </p>
                    </div>

                    <a href="{{ route('category.products', ['id' => $category->id]) }}" 
                       class="absolute inset-0 z-10" 
                       aria-label="View {{ $category->name }}">
                    </a>
                    
                    <div class="absolute top-4 right-4 bg-white bg-opacity-75 rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- About Our Services Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">About Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out p-8">
                    <div class="text-5xl text-green-500 mb-6">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Fresh & Vibrant</h3>
                    <p class="text-gray-600 leading-relaxed">
                        We source only the freshest flowers to ensure your bouquets stay vibrant and beautiful for longer.
                        Our commitment to quality is unmatched in the industry.
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out p-8">
                    <div class="text-5xl text-blue-500 mb-6">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Swift Delivery</h3>
                    <p class="text-gray-600 leading-relaxed">
                        With our efficient delivery system, your flowers arrive on time and in perfect condition. We
                        understand the importance of punctuality in expressing your sentiments.
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out p-8">
                    <div class="text-5xl text-purple-500 mb-6">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Customized Arrangements</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Our expert florists can create custom arrangements to suit any occasion. Let us help you express
                        your feelings through the language of flowers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Products Section -->
    <section class="bg-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-4xl font-bold flex items-center text-gray-800">
                    <i class="fas fa-fire text-red-500 mr-4"></i>
                    Popular Products
                </h2>
                <a href="{{ route('products.index') }}"
                    class="text-lg text-red-500 hover:text-red-600 font-medium transition duration-300 ease-in-out">
                    SEE ALL PRODUCTS
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image->path) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition duration-300">
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
        </div>
    </section>

    
@endsection
