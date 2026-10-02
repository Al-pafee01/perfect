<?php

namespace App\Http\Controllers;

use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::where('is_available', true)->get();

        return view('menu', compact('foods'));
    }
}