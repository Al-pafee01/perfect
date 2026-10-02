<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class AdminFoodController extends Controller
{
    /**
     * Display all foods.
     */
    public function index()
    {
        $foods = Food::latest()->get();

        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Show form for creating a new food.
     */
    public function create()
    {
        return view('admin.foods.create');
    }

    /**
     * Store a new food.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['is_available'] = $request->has('is_available');

        Food::create($validated);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Food added successfully.');
    }

    /**
     * Display one food.
     */
    public function show(Food $food)
    {
        return view('admin.foods.show', compact('food'));
    }

    /**
     * Show form for editing a food.
     */
    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    /**
     * Update a food.
     */
    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['is_available'] = $request->has('is_available');

        $food->update($validated);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Food updated successfully.');
    }

    /**
     * Delete a food.
     */
    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()
            ->route('foods.index')
            ->with('success', 'Food deleted successfully.');
    }
}