<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminUserController;


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
| EMAIL VERIFICATION
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});


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


Route::post('/forgot-password', [PasswordResetController::class, 'sendLink'])
    ->middleware('throttle:6,1')
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->middleware('throttle:10,1')
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->middleware('throttle:6,1')
    ->name('password.update');


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
    ->middleware(['auth', 'verified'])
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
})->middleware(['auth', 'verified'])->name('order');


/*
|--------------------------------------------------------------------------
| SAVE CUSTOMER ORDER
|--------------------------------------------------------------------------
*/

Route::post('/order', [OrderController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('order.store');


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])
    ->get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )
    ->name('admin.dashboard');

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{userId}', [AdminUserController::class, 'show'])->whereNumber('userId')->name('users.show');
        Route::get('/users/{userId}/edit', [AdminUserController::class, 'edit'])->whereNumber('userId')->name('users.edit');
        Route::patch('/users/{userId}', [AdminUserController::class, 'update'])->whereNumber('userId')->name('users.update');
        Route::post('/users/{userId}/password-reset', [AdminUserController::class, 'sendPasswordResetLink'])->whereNumber('userId')->middleware('throttle:6,1')->name('users.password-reset');
        Route::delete('/users/{userId}', [AdminUserController::class, 'destroy'])->whereNumber('userId')->name('users.destroy');
        Route::patch('/users/{userId}/restore', [AdminUserController::class, 'restore'])->whereNumber('userId')->name('users.restore');
    });


/*
|--------------------------------------------------------------------------
| ADMIN FOOD MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])->group(function () {

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

Route::middleware(['auth', 'verified', 'admin'])
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

Route::middleware(['auth', 'verified', 'admin'])
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