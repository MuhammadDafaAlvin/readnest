<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return request()->expectsJson()
            ? response()->json($categories)
            : view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category = Category::create($request->all());
        return request()->expectsJson()
            ? response()->json($category, 201)
            : redirect()->route('categories.index')->with('success', 'Kategori dibuat.');
    }

    public function show(Category $category)
    {
        return request()->expectsJson()
            ? response()->json($category)
            : view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());
        return request()->expectsJson()
            ? response()->json($category)
            : redirect()->route('categories.index')->with('success', 'Kategori diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return request()->expectsJson()
            ? response()->json(['message' => 'Kategori dihapus'])
            : redirect()->route('categories.index')->with('success', 'Kategori dihapus.');
    }
}
