<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Food;
use Illuminate\Support\Facades\DB;

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

        $todayRevenue = Order::where('status', 'completed')
            ->whereDate('completed_at', today())
            ->sum('total_amount');

        $monthRevenue = Order::where('status', 'completed')
            ->whereBetween('completed_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total_amount');

        $popularFoods = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('foods', 'foods.id', '=', 'order_items.food_id')
            ->whereIn('orders.status', ['pending', 'preparing', 'ready', 'completed'])
            ->select('foods.name', DB::raw('SUM(order_items.quantity) as quantity_sold'))
            ->groupBy('foods.id', 'foods.name')
            ->orderByDesc('quantity_sold')
            ->limit(5)
            ->get();

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
            'todayRevenue',
            'monthRevenue',
            'popularFoods',
            'recentOrders'
        ));
    }
}