@extends('layouts.app')

@section('title', 'Manage Orders - Kessy Brothers Food')

@section('content')

<div class="admin-orders-page">

    <div class="admin-orders-container">

        <!-- HEADER -->
        <div class="page-header">

            <div>
                <span class="page-label">ADMIN PANEL</span>

                <h1>Customer Orders</h1>

                <p>
                    View and manage all customer food orders.
                </p>
            </div>

            <div class="order-count">
                <strong>{{ $orders->total() }}</strong>
                <span>Total Orders</span>
            </div>

        </div>


        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="success-message">
                ✓ {{ session('success') }}
            </div>

        @endif


        <form class="order-filters" method="GET" action="{{ route('admin.orders.index') }}">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search customer, phone or order #" aria-label="Search orders">
            <select name="status" aria-label="Filter by status">
                <option value="">All statuses</option>
                @foreach(['pending', 'preparing', 'ready', 'completed', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}" aria-label="Filter by date">
            <button type="submit">Apply filters</button>
            <a href="{{ route('admin.orders.index') }}">Clear</a>
        </form>

        <!-- ORDERS -->
        @if($orders->count())

            <div class="orders-table-wrapper">

                <table class="orders-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Customer</th>

                            <th>Items</th>

                            <th>Type</th>

                            <th>Total</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>
                                    <strong>
                                        #{{ $order->id }}
                                    </strong>
                                </td>

                                <td>

                                    <div class="customer-cell">

                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($order->customer_name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <strong>
                                                {{ $order->customer_name }}
                                            </strong>

                                            <small>
                                                {{ $order->phone ?? 'No phone' }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>{{ ucfirst($order->fulfillment_type ?? 'delivery') }}</td>

                                <td>

                                    <div class="items-cell">

                                        @foreach($order->items as $item)

                                            <span>
                                                {{ $item->food->name ?? 'Food' }}
                                                × {{ $item->quantity }}
                                            </span>

                                        @endforeach

                                    </div>

                                </td>


                                <td>

                                    <strong class="price">
                                        TSh {{ number_format($order->total_amount) }}
                                    </strong>

                                </td>


                                <td>

                                    <span class="status status-{{ $order->status }}">

                                        {{ ucfirst($order->status) }}

                                    </span>

                                </td>


                                <td>

                                    <span class="date">

                                        {{ $order->created_at->format('d M Y') }}

                                        <small>
                                            {{ $order->created_at->format('H:i') }}
                                        </small>

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="view-button"
                                    >
                                        View
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <!-- EMPTY -->
            <div class="empty-orders">

                <div class="empty-icon">
                    🛒
                </div>

                <h2>{{ request()->hasAny(['search', 'status', 'date']) ? 'No Matching Orders' : 'No Orders Yet' }}</h2>

                <p>
                    {{ request()->hasAny(['search', 'status', 'date']) ? 'Try removing one or more filters.' : 'Customer orders will appear here when they place an order.' }}
                </p>

            </div>

        @endif

        @if($orders->hasPages())
            <nav class="orders-pagination" aria-label="Order pages">
                <span>Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</span>
                @if($orders->previousPageUrl())
                    <a href="{{ $orders->previousPageUrl() }}" rel="prev">Previous</a>
                @endif
                @if($orders->nextPageUrl())
                    <a href="{{ $orders->nextPageUrl() }}" rel="next">Next</a>
                @endif
            </nav>
        @endif

    </div>

</div>


<style>

.admin-orders-page {
    min-height: 100vh;
    background: #f8fafc;
    padding: 120px 20px 70px;
}

.admin-orders-container {
    max-width: 1250px;
    margin: auto;
}

.order-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    margin: 0 0 22px;
}

.order-filters input,
.order-filters select {
    min-height: 44px;
    padding: 9px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    background: white;
}

.order-filters button {
    min-height: 44px;
    padding: 9px 16px;
    border: 0;
    border-radius: 10px;
    background: #1aaed0;
    color: #102033;
    font-weight: 700;
    cursor: pointer;
}

.order-filters a {
    color: var(--brand-accent-dark);
    font-weight: 700;
}

.orders-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    margin-top: 24px;
}

.orders-pagination a {
    padding: 8px 14px;
    border-radius: 10px;
    background: var(--brand-primary);
    color: white;
    text-decoration: none;
    font-weight: 700;
}


/* HEADER */

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
    margin-bottom: 30px;
}

.page-label {
    color: var(--brand-accent);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 2px;
}

.page-header h1 {
    margin: 8px 0 5px;
    color: #0f172a;
    font-family: 'Space Grotesk', sans-serif;
    font-size: 38px;
}

.page-header p {
    margin: 0;
    color: #64748b;
}


/* COUNT */

.order-count {
    min-width: 120px;
    padding: 18px 22px;
    border-radius: 16px;
    background: white;
    border: 1px solid #e2e8f0;
    text-align: center;
}

.order-count strong {
    display: block;
    color: var(--brand-accent);
    font-size: 28px;
}

.order-count span {
    color: #64748b;
    font-size: 13px;
}


/* SUCCESS */

.success-message {
    margin-bottom: 20px;
    padding: 15px 18px;
    border-radius: 12px;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #047857;
    font-weight: 700;
}


/* TABLE */

.orders-table-wrapper {
    overflow-x: auto;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
}

.orders-table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
}

.orders-table th {
    padding: 17px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .7px;
    text-align: left;
}

.orders-table td {
    padding: 18px 17px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
    color: #334155;
}

.orders-table tbody tr:hover {
    background: #f8fafc;
}

.orders-table tbody tr:last-child td {
    border-bottom: none;
}


/* CUSTOMER */

.customer-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #eff6ff;
    color: var(--brand-accent);

    font-weight: 800;
}

.customer-cell strong {
    display: block;
    color: #0f172a;
}

.customer-cell small {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
}


/* ITEMS */

.items-cell {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.items-cell span {
    font-size: 13px;
    color: #475569;
}


/* PRICE */

.price {
    color: #0f172a;
    white-space: nowrap;
}


/* STATUS */

.status {
    display: inline-flex;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 800;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-preparing {
    background: #dbeafe;
    color: var(--brand-accent-dark);
}

.status-ready {
    background: #cffafe;
    color: #0e7490;
}

.status-completed {
    background: #dcfce7;
    color: #166534;
}

.status-cancelled {
    background: #fee2e2;
    color: #b91c1c;
}


/* DATE */

.date {
    display: block;
    white-space: nowrap;
    font-size: 13px;
}

.date small {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
}


/* BUTTON */

.view-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 9px 15px;

    border-radius: 9px;

    background: var(--brand-accent);
    color: white;

    font-size: 13px;
    font-weight: 700;

    text-decoration: none;

    transition: .2s;
}

.view-button:hover {
    background: var(--brand-accent-dark);
    transform: translateY(-1px);
}


/* EMPTY */

.empty-orders {
    padding: 80px 25px;
    text-align: center;

    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
}

.empty-icon {
    font-size: 55px;
    margin-bottom: 15px;
}

.empty-orders h2 {
    margin: 0 0 8px;
    color: #0f172a;
}

.empty-orders p {
    margin: 0;
    color: #64748b;
}


/* MOBILE */

@media (max-width: 700px) {

    .admin-orders-page {
        padding: 100px 15px 50px;
    }

    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .page-header h1 {
        font-size: 30px;
    }

    .order-count {
        width: 100%;
        box-sizing: border-box;
    }

}

</style>

@endsection