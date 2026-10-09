<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        request()->validate([
            'status' => 'nullable|in:pending,preparing,ready,completed,cancelled',
            'search' => 'nullable|string|max:100',
            'date' => 'nullable|date',
        ]);

        $orders = Order::with(['user', 'items.food'])
            ->when(request()->filled('status'), fn ($query) => $query->where('status', request('status')))
            ->when(request()->filled('search'), function ($query) {
                $search = trim((string) request('search'));

                $query->where(function ($query) use ($search) {
                    $query->where('customer_name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('id', $search);
                });
            })
            ->when(request()->filled('date'), fn ($query) => $query->whereDate('created_at', request('date')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.food']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed,cancelled',
        ]);

        $status = $request->status;
        $order->update([
            'status' => $status,
            'completed_at' => $status === 'completed' ? ($order->completed_at ?? now()) : null,
        ]);

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }
}