<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateCategoryRequest;

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

        
        $categories = Category::inRandomOrder()->with(['images' => function ($query) {
            $query->inRandomOrder()->take(1);
        }])->take(4)->get();
    
        foreach ($categories as $category) {
            $category->image = $category->images->first();
        }
    
        return view('welcome', compact('categories'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());

            if ($request->hasFile('images')) {
                foreach ($category->images as $image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }

                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $category->images()->create(['path' => $path]);
                }
            }

            return redirect()->back()->withInput()->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while updating the category. Please try again.');
        }
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
