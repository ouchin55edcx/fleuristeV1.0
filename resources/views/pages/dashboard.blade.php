@extends('layouts')

@section('content')
    <div class="bg-gray-100 min-h-full">
        <!-- Main Content -->
        <main class="p-8 mt-12">
            <!-- Statistics Cards -->
            <section id="statistics" class="mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Flowers Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-full p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-gray-600 text-sm font-medium">Total Flowers</h2>
                                <p class="text-3xl font-bold text-gray-900">256</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Categories Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-full p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-gray-600 text-sm font-medium">Total Categories</h2>
                                <p class="text-3xl font-bold text-gray-900">12</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Sales Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-full p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-gray-600 text-sm font-medium">Total Sales</h2>
                                <p class="text-3xl font-bold text-gray-900">$12,345</p>
                            </div>
                        </div>
                    </div>

                    <!-- New Orders Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-full p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-gray-600 text-sm font-medium">New Orders</h2>
                                <p class="text-3xl font-bold text-gray-900">23</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Flowers Section -->
            <section id="flowers" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Manage Flowers</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <button onclick="openAddFlowerPopup()"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                            Add New Flower
                        </button>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-left py-3 px-4">Name</th>
                                <th class="text-left py-3 px-4">Category</th>
                                <th class="text-left py-3 px-4">Price</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-3 px-4">Elegant Rose Bouquet</td>
                                <td class="py-3 px-4">Roses</td>
                                <td class="py-3 px-4">$49.99</td>
                                <td class="py-3 px-4">
                                    <button onclick="openEditFlowerPopup()"
                                        class="text-blue-600 hover:text-blue-800 mr-2"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Categories Section -->
            <section id="categories">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Manage Categories</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <button onclick="openAddCategoryPopup()"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                            Add New Category
                        </button>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-left py-3 px-4">Category Name</th>
                                <th class="text-left py-3 px-4">Number of Flowers</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-b">
                                    <td class="py-3 px-4">{{ $category->name }}</td>
                                    <td class="py-3 px-4">{{ $category->flowers_count }}</td>
                                    <td class="py-3 px-4">
                                        <button onclick="openEditCategoryPopup({{ $category->id }})"
                                            class="text-blue-600 hover:text-blue-800 mr-2"><i
                                                class="fas fa-edit"></i></button>
                                        <form action="#" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <!-- Add Flower Popup -->
    <dialog id="flowerPopup" class="rounded-lg shadow-xl p-0 w-full max-w-md">
        <div class="bg-white rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white px-4 py-2 flex justify-between items-center">
                <h3 class="text-lg font-semibold" id="flowerPopupTitle">Add New Flower</h3>
                <button onclick="closeFlowerPopup()" class="text-white hover:text-gray-200">&times;</button>
            </div>
            <form id="flowerForm" class="p-4">
                <div class="mb-4">
                    <label for="flowerName" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="flowerName" name="name" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="flowerCategory" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select id="flowerCategory" name="category" class="w-full px-3 py-2 border rounded-md" required>
                        <option value="">Select a category</option>
                        <!-- Add category options here -->
                    </select>
                </div>
                <div class="mb-4">
                    <label for="flowerPrice" class="block text-gray-700 font-bold mb-2">Price</label>
                    <input type="number" id="flowerPrice" name="price" step="0.01"
                        class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeFlowerPopup()"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition duration-200">Cancel</button>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">Save</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Edit Flower Popup -->
    <dialog id="editflower" class="rounded-lg shadow-xl p-0 w-full max-w-md">
        <div class="bg-white rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white px-4 py-2 flex justify-between items-center">
                <h3 class="text-lg font-semibold" id="flowerPopupTitle">Add New Flower</h3>
                <button onclick="closeFlowerPopup()" class="text-white hover:text-gray-200">&times;</button>
            </div>
            <form id="flowerForm" class="p-4">
                <div class="mb-4">
                    <label for="flowerName" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="flowerName" name="name" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="flowerCategory" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select id="flowerCategory" name="category" class="w-full px-3 py-2 border rounded-md" required>
                        <option value="">Select a category</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="flowerPrice" class="block text-gray-700 font-bold mb-2">Price</label>
                    <input type="number" id="flowerPrice" name="price" step="0.01"
                        class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeFlowerPopup()"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition duration-200">Cancel</button>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">Save</button>
                </div>
            </form>
        </div>
    </dialog>

<!-- Add Category Popup -->
<dialog id="categoryPopup" class="rounded-lg shadow-xl p-0 w-full max-w-md">
    <div class="bg-white rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-4 py-2 flex justify-between items-center">
            <h3 class="text-lg font-semibold" id="categoryPopupTitle">Add New Category</h3>
            <button onclick="closeCategoryPopup()" class="text-white hover:text-gray-200">&times;</button>
        </div>
        <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" class="p-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="categoryName" class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input type="text" id="categoryName" name="name" class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="images" class="block text-gray-700 font-bold mb-2">Images</label>
                <input type="file" id="images" name="images[]" class="w-full px-3 py-2 border rounded-md" multiple>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeCategoryPopup()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition duration-200">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">Save</button>
            </div>
        </form>
    </div>
</dialog>


    <!-- Edit Category Popup -->
    <dialog id="editcategory" class="rounded-lg shadow-xl p-0 w-full max-w-md">
        <div class="bg-white rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-4 py-2 flex justify-between items-center">
                <h3 class="text-lg font-semibold" id="categoryPopupTitle">Add New Category</h3>
                <button onclick="closeCategoryPopup()" class="text-white hover:text-gray-200">&times;</button>
            </div>
            <form id="categoryForm" class="p-4">
                <div class="mb-4">
                    <label for="categoryName" class="block text-gray-700 font-bold mb-2">Category Name</label>
                    <input type="text" id="categoryName" name="name" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeCategoryPopup()"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition duration-200">Cancel</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">Save</button>
                </div>
            </form>
        </div>
    </dialog>

    <script src="js/dashboard.js"></script>
@endsection
