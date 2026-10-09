@extends('layouts.app')

@section('title', 'Admin Dashboard - Kessy Brothers Food')

@section('content')

<div class="admin-dashboard">

    {{-- =====================================================
        HERO
    ====================================================== --}}
    <section class="admin-hero">

        <div class="admin-container">

            <div>
                <span class="admin-label">
                    ADMIN PANEL
                </span>

                <h1>
                    Dashboard Overview
                </h1>

                <p>
                    Manage your food business, monitor orders,
                    and track customer activity.
                </p>
            </div>

            <div class="admin-hero-icon">
                <img src="{{ asset('images/kessy-tech-pro-logo.png') }}" alt="Kessy Tech Pro logo">
            </div>

        </div>

    </section>


    {{-- =====================================================
        MAIN CONTENT
    ====================================================== --}}
    <section class="admin-content">

        <div class="admin-container">


            {{-- =================================================
                QUICK ACTIONS
            ================================================== --}}
            <div class="top-actions">

                <div>
                    <span class="section-label">
                        OVERVIEW
                    </span>

                    <h2>
                        Business Summary
                    </h2>
                </div>

                <div class="action-buttons">

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="action-button blue"
                    >
                        📦 Manage Orders
                    </a>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="action-button blue"
                    >
                        👥 Manage Customers
                    </a>

                    <a
                        href="{{ route('foods.index') }}"
                        class="action-button orange"
                    >
                        🍔 Manage Foods
                    </a>

                </div>

            </div>


            {{-- =================================================
                STATISTICS
            ================================================== --}}
            <div class="stats-grid">


                {{-- TOTAL ORDERS --}}
                <div class="stat-card">

                    <div class="stat-icon blue-icon">
                        📦
                    </div>

                    <div class="stat-info">

                        <span>
                            Total Orders
                        </span>

                        <strong>
                            {{ $totalOrders }}
                        </strong>

                    </div>

                </div>


                {{-- PENDING --}}
                <div class="stat-card pending-card">

                    <div class="stat-icon pending-icon">
                        ⏳
                    </div>

                    <div class="stat-info">

                        <span>
                            Pending Orders
                        </span>

                        <strong>
                            {{ $pendingOrders }}
                        </strong>

                    </div>

                </div>


                {{-- PREPARING --}}
                <div class="stat-card preparing-card">

                    <div class="stat-icon preparing-icon">
                        👨‍🍳
                    </div>

                    <div class="stat-info">

                        <span>
                            Preparing
                        </span>

                        <strong>
                            {{ $preparingOrders }}
                        </strong>

                    </div>

                </div>


                {{-- READY --}}
                <div class="stat-card ready-card">

                    <div class="stat-icon ready-icon">
                        🔔
                    </div>

                    <div class="stat-info">

                        <span>
                            Ready Orders
                        </span>

                        <strong>
                            {{ $readyOrders }}
                        </strong>

                    </div>

                </div>


                {{-- COMPLETED --}}
                <div class="stat-card completed-card">

                    <div class="stat-icon completed-icon">
                        ✅
                    </div>

                    <div class="stat-info">

                        <span>
                            Completed
                        </span>

                        <strong>
                            {{ $completedOrders }}
                        </strong>

                    </div>

                </div>


                {{-- CANCELLED --}}
                <div class="stat-card cancelled-card">

                    <div class="stat-icon cancelled-icon">
                        ❌
                    </div>

                    <div class="stat-info">

                        <span>
                            Cancelled
                        </span>

                        <strong>
                            {{ $cancelledOrders }}
                        </strong>

                    </div>

                </div>


                {{-- TOTAL FOODS --}}
                <div class="stat-card foods-card">

                    <div class="stat-icon foods-icon">
                        🍔
                    </div>

                    <div class="stat-info">

                        <span>
                            Total Foods
                        </span>

                        <strong>
                            {{ $totalFoods }}
                        </strong>

                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue-icon">💰</div>
                    <div class="stat-info">
                        <span>Today's completed sales</span>
                        <strong>TSh {{ number_format($todayRevenue) }}</strong>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue-icon">📈</div>
                    <div class="stat-info">
                        <span>This month's completed sales</span>
                        <strong>TSh {{ number_format($monthRevenue) }}</strong>
                    </div>
                </div>
            </div>

            <section class="recent-section">
                    <div class="section-heading">
                        <div>
                            <span class="section-label">MENU PERFORMANCE</span>
                            <h2>Popular Foods</h2>
                            <p>Top ordered meals, excluding cancelled orders.</p>
                        </div>
                    </div>
                    @forelse($popularFoods as $food)
                        <div class="popular-food-row">
                            <span>{{ $loop->iteration }}. {{ $food->name }}</span>
                            <strong>{{ number_format($food->quantity_sold) }} sold</strong>
                        </div>
                    @empty
                        <p>No completed meal activity yet.</p>
                    @endforelse
            </section>


            {{-- =================================================
                RECENT ORDERS
            ================================================== --}}
            <div class="recent-section">

                <div class="section-heading">

                    <div>

                        <span class="section-label">
                            ORDER ACTIVITY
                        </span>

                        <h2>
                            Recent Orders
                        </h2>

                        <p>
                            Latest customer orders and their current status.
                        </p>

                    </div>

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="view-all-button"
                    >
                        View All Orders →
                    </a>

                </div>


                @if($recentOrders->isEmpty())

                    <div class="empty-orders">

                        <div class="empty-icon">
                            📦
                        </div>

                        <h3>
                            No Orders Yet
                        </h3>

                        <p>
                            Customer orders will appear here once they are placed.
                        </p>

                    </div>

                @else

                    <div class="recent-orders-list">

                        @foreach($recentOrders as $order)

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


                            <div class="recent-order-card">


                                {{-- ORDER INFO --}}
                                <div class="recent-order-main">

                                    <div class="order-number">

                                        <span>
                                            ORDER
                                        </span>

                                        <strong>
                                            #{{ $order->id }}
                                        </strong>

                                    </div>


                                    <div class="customer-info">

                                        <strong>
                                            {{ $order->customer_name }}
                                        </strong>

                                        <small>
                                            {{ $order->phone ?? 'No phone number' }}
                                        </small>

                                    </div>

                                </div>


                                {{-- FOOD --}}
                                <div class="recent-food">

                                    <span>
                                        🍽️
                                    </span>

                                    <div>

                                        @foreach($order->items as $item)

                                            <strong>
                                                {{ $item->food->name ?? 'Food Item' }}
                                            </strong>

                                            @if(!$loop->last)
                                                <span class="plus-food"> + </span>
                                            @endif

                                        @endforeach

                                        <small>
                                            {{ $order->items->sum('quantity') }}
                                            item(s)
                                        </small>

                                    </div>

                                </div>


                                {{-- TOTAL --}}
                                <div class="recent-total">

                                    <span>
                                        TOTAL
                                    </span>

                                    <strong>
                                        TSh {{ number_format($order->total_amount) }}
                                    </strong>

                                </div>


                                {{-- STATUS --}}
                                <div>

                                    <span class="order-status {{ $statusClass }}">

                                        {{ $statusIcon }}

                                        {{ ucfirst($order->status) }}

                                    </span>

                                </div>


                                {{-- VIEW --}}
                                <a
                                    href="{{ route('admin.orders.show', $order) }}"
                                    class="view-order"
                                >
                                    View →
                                </a>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =================================================
                ADMIN SHORTCUTS
            ================================================== --}}
            <div class="shortcuts-section">

                <div class="section-heading">

                    <div>

                        <span class="section-label">
                            MANAGEMENT
                        </span>

                        <h2>
                            Quick Management
                        </h2>

                    </div>

                </div>


                <div class="shortcuts-grid">


                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="shortcut-card"
                    >

                        <div class="shortcut-icon">
                            📦
                        </div>

                        <div>

                            <h3>
                                Order Management
                            </h3>

                            <p>
                                View customer orders and update
                                their status.
                            </p>

                        </div>

                        <span>
                            →
                        </span>

                    </a>


                    <a
                        href="{{ route('foods.index') }}"
                        class="shortcut-card"
                    >

                        <div class="shortcut-icon food-shortcut">
                            🍔
                        </div>

                        <div>

                            <h3>
                                Food Management
                            </h3>

                            <p>
                                Add, edit, view and delete food
                                items from your menu.
                            </p>

                        </div>

                        <span>
                            →
                        </span>

                    </a>


                </div>

            </div>


        </div>

    </section>

</div>


<style>

/* =========================================================
   GENERAL
========================================================= */

.admin-dashboard {

    min-height: 80vh;

    background: #f8fafc;

}

.admin-container {

    width: 100%;

    max-width: 1200px;

    margin: auto;

}


/* =========================================================
   HERO
========================================================= */

.admin-hero {

    padding: 65px 20px;

    background:
        linear-gradient(
            135deg,
            #0f172a,
            #1e3a8a
        );

    color: white;

}

.admin-hero .admin-container {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

}

.admin-label {

    color: #38bdf8;

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 2px;

}

.admin-hero h1 {

    margin: 10px 0;

    font-size: 42px;

    line-height: 1.15;

}

.admin-hero p {

    margin: 0;

    color: #cbd5e1;

    max-width: 600px;

    line-height: 1.7;

}

.admin-hero-icon {

    width: 85px;

    height: 85px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 22px;

    background: rgba(255,255,255,.10);

    border: 1px solid rgba(255,255,255,.15);

    font-size: 40px;

}

.admin-hero-icon img {
    width: 58px;
    height: 58px;
    object-fit: contain;
}


/* =========================================================
   CONTENT
========================================================= */

.admin-content {

    padding: 55px 20px 70px;

}


/* =========================================================
   TOP ACTIONS
========================================================= */

.top-actions {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 25px;

    margin-bottom: 25px;

}

.section-label {

    color: #06b6d4;

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 2px;

}

.top-actions h2,
.section-heading h2 {

    margin: 8px 0 0;

    color: #0f172a;

    font-size: 27px;

}

.action-buttons {

    display: flex;

    gap: 10px;

    flex-wrap: wrap;

}

.action-button {

    display: inline-block;

    padding: 11px 17px;

    border-radius: 10px;

    color: white;

    text-decoration: none;

    font-size: 13px;

    font-weight: 700;

    transition: .2s;

}

.action-button:hover {

    transform: translateY(-2px);

}

.action-button.blue {

    background: var(--brand-accent);

}

.action-button.orange {

    background: #f97316;

}


/* =========================================================
   STATS
========================================================= */

.stats-grid {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 18px;

}

.stat-card {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 20px;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 17px;

    transition: .25s;

}

.stat-card:hover {

    transform: translateY(-3px);

    box-shadow:
        0 12px 30px rgba(15,23,42,.08);

}

.stat-icon {

    width: 50px;

    height: 50px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    font-size: 22px;

}

.blue-icon {

    background: #dbeafe;

}

.pending-icon {

    background: #fef3c7;

}

.preparing-icon {

    background: #dbeafe;

}

.ready-icon {

    background: #cffafe;

}

.completed-icon {

    background: #dcfce7;

}

.cancelled-icon {

    background: #fee2e2;

}

.foods-icon {

    background: #ffedd5;

}

.stat-info span {

    display: block;

    color: #64748b;

    font-size: 13px;

}

.stat-info strong {

    display: block;

    margin-top: 4px;

    color: #0f172a;

    font-size: 25px;

}


/* =========================================================
   RECENT ORDERS
========================================================= */

.recent-section {

    margin-top: 65px;

}

.popular-food-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 13px 16px;
    border-bottom: 1px solid #e2e8f0;
    color: #26364b;
}

.popular-food-row:last-child {
    border-bottom: 0;
}

.popular-food-row strong {
    color: var(--brand-accent-dark);
    white-space: nowrap;
}

.section-heading {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 22px;

}

.section-heading p {

    margin: 7px 0 0;

    color: #64748b;

}

.view-all-button {

    padding: 11px 17px;

    background: var(--brand-accent);

    color: white;

    text-decoration: none;

    border-radius: 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

}


/* =========================================================
   EMPTY
========================================================= */

.empty-orders {

    text-align: center;

    padding: 65px 25px;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

}

.empty-icon {

    font-size: 50px;

    margin-bottom: 10px;

}

.empty-orders h3 {

    margin: 0 0 8px;

    color: #0f172a;

}

.empty-orders p {

    margin: 0;

    color: #64748b;

}


/* =========================================================
   RECENT ORDER CARD
========================================================= */

.recent-orders-list {

    display: flex;

    flex-direction: column;

    gap: 12px;

}

.recent-order-card {

    display: grid;

    grid-template-columns:
        1fr
        1.2fr
        1fr
        auto
        auto;

    align-items: center;

    gap: 20px;

    padding: 20px;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 16px;

    transition: .2s;

}

.recent-order-card:hover {

    border-color: #93c5fd;

    box-shadow:
        0 10px 25px rgba(15,23,42,.06);

}

.order-number span,
.recent-total span {

    display: block;

    color: #94a3b8;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.5px;

}

.order-number strong {

    display: block;

    margin-top: 4px;

    color: #0f172a;

    font-size: 20px;

}

.customer-info strong {

    display: block;

    color: #334155;

    font-size: 14px;

}

.customer-info small {

    display: block;

    margin-top: 4px;

    color: #94a3b8;

}

.recent-food {

    display: flex;

    align-items: center;

    gap: 10px;

}

.recent-food > span {

    width: 40px;

    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: #eff6ff;

    font-size: 19px;

}

.recent-food strong {

    color: #334155;

    font-size: 13px;

}

.recent-food small {

    display: block;

    margin-top: 4px;

    color: #94a3b8;

}

.plus-food {

    color: #94a3b8;

}

.recent-total strong {

    display: block;

    margin-top: 4px;

    color: var(--brand-accent);

    font-size: 14px;

}


/* =========================================================
   STATUS
========================================================= */

.order-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 8px 12px;

    border-radius: 30px;

    font-size: 12px;

    font-weight: 800;

    white-space: nowrap;

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


/* =========================================================
   VIEW ORDER
========================================================= */

.view-order {

    color: var(--brand-accent);

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    white-space: nowrap;

}

.view-order:hover {

    text-decoration: underline;

}


/* =========================================================
   SHORTCUTS
========================================================= */

.shortcuts-section {

    margin-top: 65px;

}

.shortcuts-grid {

    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 20px;

}

.shortcut-card {

    display: flex;

    align-items: center;

    gap: 16px;

    padding: 23px;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 17px;

    color: inherit;

    text-decoration: none;

    transition: .25s;

}

.shortcut-card:hover {

    transform: translateY(-3px);

    border-color: #93c5fd;

    box-shadow:
        0 12px 30px rgba(15,23,42,.08);

}

.shortcut-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: #dbeafe;

    font-size: 23px;

}

.food-shortcut {

    background: #ffedd5;

}

.shortcut-card h3 {

    margin: 0 0 5px;

    color: #0f172a;

    font-size: 17px;

}

.shortcut-card p {

    margin: 0;

    color: #64748b;

    font-size: 13px;

    line-height: 1.5;

}

.shortcut-card > span {

    margin-left: auto;

    color: var(--brand-accent);

    font-size: 22px;

    font-weight: 800;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1050px) {

    .stats-grid {

        grid-template-columns:
            repeat(3, 1fr);

    }

    .recent-order-card {

        grid-template-columns:
            1fr
            1fr
            1fr;

    }

}

@media (max-width: 750px) {

    .admin-hero {

        padding: 50px 18px;

    }

    .admin-hero h1 {

        font-size: 31px;

    }

    .admin-hero .admin-container {

        flex-direction: column;

        align-items: flex-start;

    }

    .admin-content {

        padding: 45px 18px;

    }

    .top-actions {

        flex-direction: column;

        align-items: flex-start;

    }

    .stats-grid {

        grid-template-columns:
            repeat(2, 1fr);

    }

    .section-heading {

        flex-direction: column;

        align-items: flex-start;

    }

    .recent-order-card {

        grid-template-columns: 1fr;

        align-items: flex-start;

    }

    .shortcuts-grid {

        grid-template-columns: 1fr;

    }

}

@media (max-width: 480px) {

    .stats-grid {

        grid-template-columns: 1fr;

    }

    .action-buttons {

        width: 100%;

    }

    .action-button {

        flex: 1;

        text-align: center;

    }

}

</style>

@endsection