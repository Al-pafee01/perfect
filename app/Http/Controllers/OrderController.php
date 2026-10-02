<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Remove foods whose quantity is 0
        |--------------------------------------------------------------------------
        */

        $items = collect($request->input('items', []))
            ->filter(function ($item) {
                return isset($item['quantity'])
                    && (int) $item['quantity'] > 0;
            })
            ->values()
            ->all();


        /*
        |--------------------------------------------------------------------------
        | Validate selected foods
        |--------------------------------------------------------------------------
        */

        $validated = validator(
            [
                'items' => $items,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
            ],
            [
                'items' => 'required|array|min:1',
                'items.*.food_id' => [
                    'required',
                    Rule::exists('foods', 'id')
                        ->where(fn ($query) => $query->where('is_available', true)),
                ],
                'items.*.quantity' => 'required|integer|min:1',

                'phone' => 'nullable|string|max:30',
                'address' => 'nullable|string|max:500',
                'notes' => 'nullable|string|max:1000',
            ]
        )->validate();


        /*
        |--------------------------------------------------------------------------
        | Create order
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($validated, $items) {

            $total = 0;

            /*
            |--------------------------------------------------------------------------
            | Calculate total from database prices
            |--------------------------------------------------------------------------
            */

            foreach ($items as $item) {

                $food = Food::findOrFail($item['food_id']);

                $total +=
                    $food->price * (int) $item['quantity'];
            }


            /*
            |--------------------------------------------------------------------------
            | Save main order
            |--------------------------------------------------------------------------
            */

            $order = Order::create([

                'user_id' => Auth::id(),

                'customer_name' => Auth::user()->name,

                'phone' => $validated['phone'] ?? null,

                'address' => $validated['address'] ?? null,

                'total_amount' => $total,

                'status' => 'pending',

                'notes' => $validated['notes'] ?? null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | Save order items
            |--------------------------------------------------------------------------
            */

            foreach ($items as $item) {

                $food = Food::findOrFail($item['food_id']);

                $quantity = (int) $item['quantity'];

                $subtotal = $food->price * $quantity;


                OrderItem::create([

                    'order_id' => $order->id,

                    'food_id' => $food->id,

                    'quantity' => $quantity,

                    'price' => $food->price,

                    'subtotal' => $subtotal,

                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Redirect customer
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Your order has been placed successfully and is now Pending.'
            );
    }
}