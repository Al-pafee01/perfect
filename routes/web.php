<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FoodController;
use App\Http\Controllers\AdminFoodController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\AdminContactMessageController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $foods = \App\Models\Food::where('is_available', true)
        ->withSum([
            'orderItems as quantity_sold' => fn ($query) => $query->whereHas(
                'order',
                fn ($orders) => $orders->whereIn('status', ['pending', 'preparing', 'ready', 'completed'])
            ),
        ], 'quantity')
        ->orderByDesc('quantity_sold')
        ->latest()
        ->take(3)
        ->get();

    $mealCount = \App\Models\Food::where('is_available', true)->count();
    $categoryCount = \App\Models\Food::where('is_available', true)
        ->distinct()
        ->count('category');
    $completedOrderCount = \App\Models\Order::where('status', 'completed')->count();
    $customerCount = \App\Models\Order::where('status', 'completed')
        ->whereNotNull('user_id')
        ->distinct()
        ->count('user_id');

    return view('home', compact(
        'foods',
        'mealCount',
        'categoryCount',
        'completedOrderCount',
        'customerCount'
    ));
});


/*
|--------------------------------------------------------------------------
| ABOUT
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('about');
});


/*
|--------------------------------------------------------------------------
| MENU
|--------------------------------------------------------------------------
*/

Route::get('/menu', [FoodController::class, 'index'])
    ->name('menu');


/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| CONTACT MESSAGE
|--------------------------------------------------------------------------
*/

Route::post('/contact/message', [ContactMessageController::class, 'store'])
    ->name('contact.message.store');


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.store');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.store');


/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('password.request');


Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT

        ? back()->with(
            'status',
            __($status)
        )

        : back()->withErrors([
            'email' => __($status),
        ]);

})->name('password.email');


/*
|--------------------------------------------------------------------------
| CUSTOMER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $orders = \App\Models\Order::with([
        'items.food'
    ])
        ->where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

    return view(
        'dashboard',
        compact('orders')
    );

})
    ->middleware('auth')
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| CUSTOMER ORDER PAGE
|--------------------------------------------------------------------------
*/

Route::get('/order', function () {
    $foods = \App\Models\Food::where('is_available', true)
        ->orderBy('name')
        ->get();

    return view('order', compact('foods'));
})->name('order');


/*
|--------------------------------------------------------------------------
| SAVE CUSTOMER ORDER
|--------------------------------------------------------------------------
*/

Route::post('/order', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('order.store');


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )
    ->name('admin.dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN FOOD MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource(
        '/admin/foods',
        AdminFoodController::class
    );
});


/*
|--------------------------------------------------------------------------
| ADMIN ORDER MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/orders',
            [AdminOrderController::class, 'index']
        )->name('orders.index');

        Route::get(
            '/orders/{order}',
            [AdminOrderController::class, 'show']
        )->name('orders.show');

        Route::patch(
            '/orders/{order}/status',
            [AdminOrderController::class, 'updateStatus']
        )->name('orders.status');

    });


/*
|--------------------------------------------------------------------------
| ADMIN CONTACT MESSAGES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/messages',
            [AdminContactMessageController::class, 'index']
        )->name('messages.index');

        Route::get(
            '/messages/{message}',
            [AdminContactMessageController::class, 'show']
        )->name('messages.show');

        Route::patch(
            '/messages/{message}/read',
            [AdminContactMessageController::class, 'markAsRead']
        )->name('messages.read');

        Route::delete(
            '/messages/{message}',
            [AdminContactMessageController::class, 'destroy']
        )->name('messages.destroy');

    });