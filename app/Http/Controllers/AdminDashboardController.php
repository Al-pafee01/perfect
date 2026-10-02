<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Food;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $preparingOrders = Order::where('status', 'preparing')->count();

        $readyOrders = Order::where('status', 'ready')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $cancelledOrders = Order::where('status', 'cancelled')->count();

        $totalFoods = Food::count();

        $recentOrders = Order::with(['user', 'items.food'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalOrders',
            'pendingOrders',
            'preparingOrders',
            'readyOrders',
            'completedOrders',
            'cancelledOrders',
            'totalFoods',
            'recentOrders'
        ));
    }
}