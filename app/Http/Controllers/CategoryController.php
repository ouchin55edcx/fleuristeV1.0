<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = Category::create($request->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $category->images()->create(['path' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Category added successfully.');
        } catch (\Exception $e) {
            Log::error('Error adding category: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while adding the category. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            foreach ($category->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            $category->delete();

            return redirect()->back()->with('success', 'Category and associated images deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while deleting the category. Please try again.');
        }
    }
}
