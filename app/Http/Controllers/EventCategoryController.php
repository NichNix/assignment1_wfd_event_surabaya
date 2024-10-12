<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::all();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        EventCategory::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = EventCategory::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = EventCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    
    public function destroy($id)
    {
        $category = EventCategory::findOrFail($id);

        
        if ($category->events()->exists()) {
            return redirect()->route('categories.index')->with('error', 'Cannot delete category with associated events.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}

