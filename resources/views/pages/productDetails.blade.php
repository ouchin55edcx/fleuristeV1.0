@extends('layouts')

@section('content')
    <div class="bg-green-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white mt-12 rounded-lg shadow-xl overflow-hidden">
                <div class="md:flex">
                    <!-- Product Images -->
                    <div class="md:w-1/2 p-4">
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($product->images as $index => $image)
                                <div class="@if ($index === 0) col-span-2 @endif">
                                    <div class="relative overflow-hidden rounded-lg shadow-lg group cursor-zoom-in">
                                        <img src="{{ asset('storage/' . $image->path) }}"
                                            alt="Product Image {{ $index + 1 }}"
                                            class="w-full @if ($index === 0) h-96 @else h-48 @endif object-cover transition duration-300 transform group-hover:scale-105">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                            <span
                                                class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <i
                                                    class="fas fa-search-plus @if ($index === 0) text-3xl @else text-2xl @endif"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Details -->
                        <div class="md:w-1/2 p-8">
                            <h1 class="text-3xl font-bold text-green-800 mb-4">{{ $product->name }}</h1>
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-gray-600">(4.5 stars, 128 reviews)</span>
                            </div>
                            <p class="text-gray-600 mb-6">
                                {{ $product->description }}
                            </p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="flex items-center justify-between mb-8">
                                    <span class="text-3xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <button type="submit"
                                    class="w-full bg-black text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-green-800 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
@endsection
