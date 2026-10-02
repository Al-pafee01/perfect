@extends('layouts.app')

@section('title', 'Customer Dashboard - Kessy Brothers Food')

@section('content')

<div class="dashboard-page">

    {{-- =========================================================
        DASHBOARD HERO
    ========================================================== --}}
    <section class="dashboard-hero">

        <div class="dashboard-container">

            <div class="hero-text">

                <span class="welcome-label">
                    CUSTOMER DASHBOARD
                </span>

                <h1>
                    Welcome back,
                    <span>{{ Auth::user()->name }}</span> 👋
                </h1>

                <p>
                    Manage your account, explore delicious meals,
                    place orders, and track your orders easily.
                </p>

            </div>


            {{-- PROFILE --}}
            <div class="profile-badge">

                <div class="profile-avatar">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>

                <div>

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                    <small>
                        {{ Auth::user()->email }}
                    </small>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <section class="dashboard-content">

        <div class="dashboard-container">


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================== --}}
            @if(session('success'))

                <div class="success-message">

                    <div class="success-icon">
                        ✓
                    </div>

                    <div>

                        <strong>
                            Order Successful
                        </strong>

                        <p>
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =================================================
                QUICK ACTIONS
            ================================================== --}}
            <div class="section-heading">

                <div>

                    <span>
                        QUICK ACTIONS
                    </span>

                    <h2>
                        What would you like to do?
                    </h2>

                </div>

            </div>


            <div class="dashboard-grid">


                {{-- BROWSE MENU --}}
                <a
                    href="{{ url('/menu') }}"
                    class="dashboard-card"
                >

                    <div class="card-icon menu-icon">
                        🍽️
                    </div>

                    <div>

                        <h3>
                            Browse Menu
                        </h3>

                        <p>
                            Explore our delicious meals and
                            discover something tasty.
                        </p>

                    </div>

                    <span class="card-arrow">
                        →
                    </span>

                </a>


                {{-- ORDER FOOD --}}
                <a
                    href="{{ url('/order') }}"
                    class="dashboard-card"
                >

                    <div class="card-icon order-icon">
                        🛒
                    </div>

                    <div>

                        <h3>
                            Order Food
                        </h3>

                        <p>
                            Choose your favorite food and
                            place a new order.
                        </p>

                    </div>

                    <span class="card-arrow">
                        →
                    </span>

                </a>


                {{-- MY PROFILE --}}
                <div class="dashboard-card">

                    <div class="card-icon profile-icon">
                        👤
                    </div>

                    <div>

                        <h3>
                            My Profile
                        </h3>

                        <p>
                            View your account information and
                            personal details.
                        </p>

                    </div>

                    <span class="coming-soon">
                        Soon
                    </span>

                </div>


                {{-- MY ORDERS --}}
                <a
                    href="#my-orders"
                    class="dashboard-card"
                >

                    <div class="card-icon orders-icon">
                        📦
                    </div>

                    <div>

                        <h3>
                            My Orders
                        </h3>

                        <p>
                            Track your current and previous
                            food orders.
                        </p>

                    </div>

                    <span class="card-arrow">
                        →
                    </span>

                </a>

            </div>


            {{-- =================================================
                MY ORDERS
            ================================================== --}}
            <div
                class="orders-section"
                id="my-orders"
            >

                <div class="section-heading orders-heading">

                    <div>

                        <span>
                            ORDER HISTORY
                        </span>

                        <h2>
                            My Orders
                        </h2>

                        <p>
                            Track the status of your food orders.
                        </p>

                    </div>

                    <a
                        href="{{ url('/order') }}"
                        class="new-order-button"
                    >
                        + New Order
                    </a>

                </div>


                {{-- NO ORDERS --}}
                @if($orders->isEmpty())

                    <div class="empty-orders">

                        <div class="empty-orders-icon">
                            🍽️
                        </div>

                        <h3>
                            No Orders Yet
                        </h3>

                        <p>
                            You haven't placed any food orders yet.
                        </p>

                        <a href="{{ url('/order') }}">
                            Order Your First Meal →
                        </a>

                    </div>

                @else


                    {{-- ORDERS LIST --}}
                    <div class="orders-list">

                        @foreach($orders as $order)

                            <div class="order-card">


                                {{-- ORDER HEADER --}}
                                <div class="order-card-header">

                                    <div>

                                        <span class="order-label">
                                            ORDER
                                        </span>

                                        <h3>
                                            #{{ $order->id }}
                                        </h3>

                                        <small>
                                            {{ $order->created_at->format('M d, Y - h:i A') }}
                                        </small>

                                    </div>


                                    {{-- STATUS --}}
                                    <div>

                                        @php

                                            $statusClass = match($order->status) {

                                                'pending' =>
                                                    'status-pending',

                                                'preparing' =>
                                                    'status-preparing',

                                                'ready' =>
                                                    'status-ready',

                                                'completed' =>
                                                    'status-completed',

                                                'cancelled' =>
                                                    'status-cancelled',

                                                default =>
                                                    'status-pending',

                                            };

                                            $statusIcon = match($order->status) {

                                                'pending' =>
                                                    '⏳',

                                                'preparing' =>
                                                    '👨‍🍳',

                                                'ready' =>
                                                    '🔔',

                                                'completed' =>
                                                    '✅',

                                                'cancelled' =>
                                                    '❌',

                                                default =>
                                                    '⏳',

                                            };

                                        @endphp


                                        <span
                                            class="order-status {{ $statusClass }}"
                                        >

                                            {{ $statusIcon }}

                                            {{ ucfirst($order->status) }}

                                        </span>

                                    </div>

                                </div>


                                {{-- ORDER BODY --}}
                                <div class="order-card-body">


                                    {{-- FOOD ITEMS --}}
                                    <div class="ordered-foods">

                                        <h4>
                                            🍴 Ordered Food
                                        </h4>


                                        @foreach($order->items as $item)

                                            <div class="ordered-food">

                                                <div class="ordered-food-info">

                                                    <div class="mini-food-icon">
                                                        🍽️
                                                    </div>

                                                    <div>

                                                        <strong>
                                                            {{ $item->food->name ?? 'Food Item' }}
                                                        </strong>

                                                        <small>
                                                            Qty:
                                                            {{ $item->quantity }}
                                                        </small>

                                                    </div>

                                                </div>


                                                <div class="food-subtotal">

                                                    TSh
                                                    {{ number_format($item->subtotal) }}

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>


                                    {{-- ORDER SUMMARY --}}
                                    <div class="order-summary-box">

                                        <div class="summary-line">

                                            <span>
                                                Total Items
                                            </span>

                                            <strong>
                                                {{ $order->items->sum('quantity') }}
                                            </strong>

                                        </div>


                                        <div class="summary-line total-line">

                                            <span>
                                                Total Amount
                                            </span>

                                            <strong>
                                                TSh
                                                {{ number_format($order->total_amount) }}
                                            </strong>

                                        </div>


                                        @if($order->address)

                                            <div class="delivery-info">

                                                <span>
                                                    📍 Delivery Address
                                                </span>

                                                <p>
                                                    {{ $order->address }}
                                                </p>

                                            </div>

                                        @endif


                                        @if($order->phone)

                                            <div class="delivery-info">

                                                <span>
                                                    📞 Phone
                                                </span>

                                                <p>
                                                    {{ $order->phone }}
                                                </p>

                                            </div>

                                        @endif


                                        @if($order->notes)

                                            <div class="delivery-info">

                                                <span>
                                                    📝 Notes
                                                </span>

                                                <p>
                                                    {{ $order->notes }}
                                                </p>

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                {{-- ORDER STATUS MESSAGE --}}
                                <div class="order-status-message">

                                    @if($order->status === 'pending')

                                        <span>
                                            ⏳
                                        </span>

                                        <p>
                                            Your order has been received
                                            and is waiting to be prepared.
                                        </p>

                                    @elseif($order->status === 'preparing')

                                        <span>
                                            👨‍🍳
                                        </span>

                                        <p>
                                            Your food is currently being
                                            prepared by our kitchen.
                                        </p>

                                    @elseif($order->status === 'ready')

                                        <span>
                                            🔔
                                        </span>

                                        <p>
                                            Your order is ready.
                                        </p>

                                    @elseif($order->status === 'completed')

                                        <span>
                                            ✅
                                        </span>

                                        <p>
                                            Your order has been completed.
                                            Thank you for ordering with us!
                                        </p>

                                    @elseif($order->status === 'cancelled')

                                        <span>
                                            ❌
                                        </span>

                                        <p>
                                            This order has been cancelled.
                                        </p>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =================================================
                ACCOUNT INFORMATION
            ================================================== --}}
            <div class="account-section">

                <div class="section-heading">

                    <div>

                        <span>
                            ACCOUNT
                        </span>

                        <h2>
                            Your Information
                        </h2>

                    </div>

                </div>


                <div class="account-card">


                    {{-- NAME --}}
                    <div class="account-row">

                        <div class="account-label">

                            <span>
                                👤
                            </span>

                            <strong>
                                Full Name
                            </strong>

                        </div>

                        <div class="account-value">

                            {{ Auth::user()->name }}

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="account-row">

                        <div class="account-label">

                            <span>
                                ✉️
                            </span>

                            <strong>
                                Email Address
                            </strong>

                        </div>

                        <div class="account-value">

                            {{ Auth::user()->email }}

                        </div>

                    </div>


                    {{-- MEMBER SINCE --}}
                    <div class="account-row">

                        <div class="account-label">

                            <span>
                                📅
                            </span>

                            <strong>
                                Member Since
                            </strong>

                        </div>

                        <div class="account-value">

                            {{ Auth::user()->created_at->format('M d, Y') }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                CTA
            ================================================== --}}
            <div class="dashboard-cta">

                <div>

                    <span>
                        READY TO ORDER?
                    </span>

                    <h2>
                        Something delicious is waiting for you.
                    </h2>

                    <p>
                        Explore our menu and choose your next delicious meal.
                    </p>

                </div>


                <a href="{{ url('/menu') }}">
                    Explore Menu →
                </a>

            </div>


            {{-- =================================================
                LOGOUT
            ================================================== --}}
            <div class="logout-area">

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button type="submit">
                        🚪 Logout
                    </button>

                </form>

            </div>

        </div>

    </section>

</div>


<style>

/* =========================================================
   GENERAL
========================================================= */

.dashboard-page {

    min-height: 80vh;

    background: #f8fafc;

}

.dashboard-container {

    width: 100%;

    max-width: 1180px;

    margin: auto;

}


/* =========================================================
   HERO
========================================================= */

.dashboard-hero {

    padding: 70px 20px;

    background:
        linear-gradient(
            135deg,
            #0f172a,
            #1e3a8a
        );

    color: white;

}

.dashboard-hero .dashboard-container {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

}

.hero-text {

    min-width: 0;

}

.welcome-label,
.section-heading span,
.dashboard-cta span,
.order-label {

    color: #06b6d4;

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 2px;

}

.dashboard-hero h1 {

    margin: 12px 0;

    font-size: 42px;

    line-height: 1.15;

}

.dashboard-hero h1 span {

    color: #38bdf8;

}

.dashboard-hero p {

    color: #cbd5e1;

    max-width: 600px;

    line-height: 1.7;

}


/* =========================================================
   PROFILE
========================================================= */

.profile-badge {

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 14px 18px;

    background: rgba(255,255,255,.10);

    border: 1px solid rgba(255,255,255,.15);

    border-radius: 16px;

    backdrop-filter: blur(10px);

}

.profile-avatar {

    width: 52px;

    height: 52px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #2563eb;

    color: white;

    font-size: 21px;

    font-weight: 800;

}

.profile-badge strong {

    display: block;

    color: white;

}

.profile-badge small {

    display: block;

    margin-top: 4px;

    color: #cbd5e1;

}


/* =========================================================
   CONTENT
========================================================= */

.dashboard-content {

    padding: 60px 20px;

}

.section-heading {

    margin-bottom: 25px;

}

.section-heading h2 {

    margin: 8px 0 0;

    color: #0f172a;

    font-size: 27px;

}

.section-heading p {

    margin: 7px 0 0;

    color: #64748b;

}


/* =========================================================
   SUCCESS MESSAGE
========================================================= */

.success-message {

    display: flex;

    align-items: center;

    gap: 15px;

    margin-bottom: 35px;

    padding: 18px 20px;

    border: 1px solid #bbf7d0;

    border-radius: 15px;

    background: #f0fdf4;

    color: #166534;

}

.success-icon {

    width: 42px;

    height: 42px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #22c55e;

    color: white;

    font-size: 22px;

    font-weight: 800;

}

.success-message strong {

    display: block;

    margin-bottom: 3px;

}

.success-message p {

    margin: 0;

    font-size: 14px;

}


/* =========================================================
   QUICK ACTIONS
========================================================= */

.dashboard-grid {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 20px;

}

.dashboard-card {

    position: relative;

    display: flex;

    flex-direction: column;

    gap: 18px;

    padding: 25px;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

    text-decoration: none;

    color: inherit;

    transition: .25s;

    min-height: 220px;

    box-sizing: border-box;

}

.dashboard-card:hover {

    transform: translateY(-5px);

    border-color: #93c5fd;

    box-shadow:
        0 15px 35px rgba(15,23,42,.10);

}

.card-icon {

    width: 55px;

    height: 55px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    font-size: 25px;

}

.menu-icon {

    background: #dbeafe;

}

.order-icon {

    background: #dcfce7;

}

.profile-icon {

    background: #fef3c7;

}

.orders-icon {

    background: #fce7f3;

}

.dashboard-card h3 {

    margin: 0 0 8px;

    color: #0f172a;

    font-size: 19px;

}

.dashboard-card p {

    margin: 0;

    color: #64748b;

    line-height: 1.6;

    font-size: 14px;

}

.card-arrow {

    margin-top: auto;

    color: #2563eb;

    font-size: 23px;

    font-weight: bold;

}

.coming-soon {

    position: absolute;

    top: 20px;

    right: 20px;

    padding: 5px 9px;

    border-radius: 20px;

    background: #f1f5f9;

    color: #64748b;

    font-size: 11px;

    font-weight: 700;

}


/* =========================================================
   ORDERS
========================================================= */

.orders-section {

    margin-top: 70px;

}

.orders-heading {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 20px;

}

.new-order-button {

    display: inline-block;

    padding: 11px 18px;

    background: #2563eb;

    color: white;

    border-radius: 10px;

    text-decoration: none;

    font-weight: 700;

    font-size: 14px;

    transition: .2s;

}

.new-order-button:hover {

    background: #1d4ed8;

    transform: translateY(-2px);

}


/* EMPTY ORDERS */

.empty-orders {

    text-align: center;

    padding: 60px 25px;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 20px;

}

.empty-orders-icon {

    font-size: 55px;

    margin-bottom: 12px;

}

.empty-orders h3 {

    margin: 0 0 8px;

    color: #0f172a;

    font-size: 22px;

}

.empty-orders p {

    margin: 0 0 20px;

    color: #64748b;

}

.empty-orders a {

    display: inline-block;

    padding: 12px 20px;

    background: #2563eb;

    color: white;

    text-decoration: none;

    border-radius: 10px;

    font-weight: 700;

}


/* ORDER CARD */

.orders-list {

    display: flex;

    flex-direction: column;

    gap: 22px;

}

.order-card {

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 20px;

    overflow: hidden;

    box-shadow:
        0 8px 25px rgba(15,23,42,.04);

}


/* ORDER HEADER */

.order-card-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 22px 25px;

    border-bottom: 1px solid #e2e8f0;

}

.order-card-header h3 {

    margin: 5px 0;

    color: #0f172a;

    font-size: 22px;

}

.order-card-header small {

    color: #64748b;

}


/* STATUS */

.order-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 8px 13px;

    border-radius: 30px;

    font-size: 13px;

    font-weight: 800;

}

.status-pending {

    background: #fef3c7;

    color: #92400e;

}

.status-preparing {

    background: #dbeafe;

    color: #1e40af;

}

.status-ready {

    background: #cffafe;

    color: #155e75;

}

.status-completed {

    background: #dcfce7;

    color: #166534;

}

.status-cancelled {

    background: #fee2e2;

    color: #991b1b;

}


/* ORDER BODY */

.order-card-body {

    display: grid;

    grid-template-columns:
        minmax(0, 1.4fr)
        minmax(250px, .8fr);

    gap: 25px;

    padding: 25px;

}


/* FOOD */

.ordered-foods h4 {

    margin: 0 0 15px;

    color: #0f172a;

    font-size: 16px;

}

.ordered-food {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 13px 0;

    border-bottom: 1px solid #f1f5f9;

}

.ordered-food:last-child {

    border-bottom: none;

}

.ordered-food-info {

    display: flex;

    align-items: center;

    gap: 12px;

}

.mini-food-icon {

    width: 43px;

    height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: #eff6ff;

    font-size: 21px;

}

.ordered-food-info strong {

    display: block;

    color: #334155;

    font-size: 14px;

}

.ordered-food-info small {

    display: block;

    margin-top: 4px;

    color: #94a3b8;

}

.food-subtotal {

    color: #0f172a;

    font-weight: 800;

    font-size: 14px;

}


/* SUMMARY */

.order-summary-box {

    padding: 20px;

    border-radius: 15px;

    background: #f8fafc;

}

.summary-line {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding-bottom: 13px;

    margin-bottom: 13px;

    border-bottom: 1px solid #e2e8f0;

}

.summary-line span {

    color: #64748b;

    font-size: 14px;

}

.summary-line strong {

    color: #334155;

}

.total-line {

    padding-bottom: 15px;

}

.total-line span {

    color: #334155;

    font-weight: 700;

}

.total-line strong {

    color: #2563eb;

    font-size: 19px;

}


/* DELIVERY */

.delivery-info {

    margin-top: 15px;

}

.delivery-info span {

    display: block;

    color: #334155;

    font-weight: 700;

    font-size: 13px;

}

.delivery-info p {

    margin: 5px 0 0;

    color: #64748b;

    font-size: 13px;

    line-height: 1.5;

}


/* STATUS MESSAGE */

.order-status-message {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 15px 25px;

    background: #f8fafc;

    border-top: 1px solid #e2e8f0;

}

.order-status-message span {

    font-size: 20px;

}

.order-status-message p {

    margin: 0;

    color: #64748b;

    font-size: 13px;

    line-height: 1.5;

}


/* =========================================================
   ACCOUNT
========================================================= */

.account-section {

    margin-top: 65px;

}

.account-card {

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

    overflow: hidden;

}

.account-row {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

    padding: 20px 25px;

    border-bottom: 1px solid #e2e8f0;

}

.account-row:last-child {

    border-bottom: none;

}

.account-label {

    display: flex;

    align-items: center;

    gap: 12px;

    color: #334155;

}

.account-value {

    color: #64748b;

    text-align: right;

    word-break: break-word;

}


/* =========================================================
   CTA
========================================================= */

.dashboard-cta {

    margin-top: 60px;

    padding: 35px;

    border-radius: 22px;

    background:
        linear-gradient(
            135deg,
            #0f172a,
            #1d4ed8
        );

    color: white;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 25px;

}

.dashboard-cta h2 {

    margin: 10px 0;

    font-size: 27px;

}

.dashboard-cta p {

    margin: 0;

    color: #cbd5e1;

}

.dashboard-cta a {

    display: inline-block;

    padding: 14px 22px;

    background: #f97316;

    color: white;

    text-decoration: none;

    border-radius: 12px;

    font-weight: 700;

    white-space: nowrap;

    transition: .25s;

}

.dashboard-cta a:hover {

    transform: translateY(-2px);

    background: #ea580c;

}


/* =========================================================
   LOGOUT
========================================================= */

.logout-area {

    text-align: center;

    margin-top: 35px;

}

.logout-area button {

    border: 1px solid #fecaca;

    background: white;

    color: #dc2626;

    padding: 12px 25px;

    border-radius: 10px;

    cursor: pointer;

    font-weight: 700;

    transition: .25s;

}

.logout-area button:hover {

    background: #fee2e2;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1000px) {

    .dashboard-grid {

        grid-template-columns:
            repeat(2, 1fr);

    }

    .dashboard-hero .dashboard-container {

        flex-direction: column;

        align-items: flex-start;

    }

    .order-card-body {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 600px) {

    .dashboard-hero {

        padding: 50px 18px;

    }

    .dashboard-hero h1 {

        font-size: 30px;

    }

    .dashboard-content {

        padding: 45px 18px;

    }

    .dashboard-grid {

        grid-template-columns: 1fr;

    }

    .profile-badge {

        width: 100%;

        box-sizing: border-box;

    }

    .account-row {

        flex-direction: column;

        align-items: flex-start;

    }

    .account-value {

        text-align: left;

    }

    .dashboard-cta {

        padding: 25px;

        flex-direction: column;

        align-items: flex-start;

    }

    .dashboard-cta h2 {

        font-size: 23px;

    }

    .dashboard-cta a {

        width: 100%;

        text-align: center;

        box-sizing: border-box;

    }

    .orders-heading {

        flex-direction: column;

        align-items: flex-start;

    }

    .order-card-header {

        align-items: flex-start;

        flex-direction: column;

    }

    .order-card-body {

        padding: 20px;

    }

    .order-card-header {

        padding: 20px;

    }

    .order-status-message {

        padding: 15px 20px;

    }

}

</style>

@endsection