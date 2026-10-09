<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'max_price' => 'nullable|numeric|min:0|max:100000000',
        ]);

        $foods = Food::where('is_available', true)
            ->when(!empty($filters['search']), function ($query) use ($filters) {
                $search = trim($filters['search']);

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
                });
            })
            ->when(!empty($filters['category']), function ($query) use ($filters) {
                $query->where('category', $filters['category']);
            })
            ->when(isset($filters['max_price']), function ($query) use ($filters) {
                $query->where('price', '<=', $filters['max_price']);
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $categories = Food::where('is_available', true)
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('menu', compact('foods', 'categories'));
    }
}