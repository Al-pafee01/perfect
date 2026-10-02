@extends('layouts.app')

@section('title', 'Order Details - Kessy Brothers Food')

@section('content')

<div class="order-details-page">

    <div class="order-details-container">

        {{-- BACK --}}
        <a href="{{ route('admin.orders.index') }}" class="back-link">
            ← Back to Orders
        </a>

        {{-- HEADER --}}
        <div class="page-header">

            <div>
                <span class="page-label">ADMIN PANEL</span>

                <h1>
                    Order #{{ $order->id }}
                </h1>

                <p>
                    Order placed on
                    {{ $order->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            <div class="status-box">
                <span class="status status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="success-message">
                ✓ {{ session('success') }}
            </div>

        @endif


        <div class="details-grid">

            {{-- CUSTOMER INFORMATION --}}
            <div class="info-card">

                <div class="card-title">
                    <span>👤</span>
                    <h2>Customer Information</h2>
                </div>

                <div class="info-list">

                    <div class="info-row">
                        <span>Name</span>
                        <strong>
                            {{ $order->customer_name }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>Email</span>
                        <strong>
                            {{ $order->user->email ?? 'No email' }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>Phone</span>
                        <strong>
                            {{ $order->phone ?? 'No phone' }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>Address</span>
                        <strong>
                            {{ $order->address ?? 'No address provided' }}
                        </strong>
                    </div>

                </div>

            </div>


            {{-- ORDER STATUS --}}
            <div class="info-card">

                <div class="card-title">
                    <span>⚙️</span>
                    <h2>Order Status</h2>
                </div>

                <form
                    action="{{ route('admin.orders.status', $order) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')

                    <label for="status">
                        Change Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="status-select"
                    >

                        <option value="pending"
                            {{ $order->status === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="preparing"
                            {{ $order->status === 'preparing' ? 'selected' : '' }}>
                            Preparing
                        </option>

                        <option value="ready"
                            {{ $order->status === 'ready' ? 'selected' : '' }}>
                            Ready
                        </option>

                        <option value="completed"
                            {{ $order->status === 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="cancelled"
                            {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                    <button type="submit" class="update-button">
                        Update Status
                    </button>

                </form>

            </div>


            {{-- ORDER ITEMS --}}
            <div class="info-card items-card">

                <div class="card-title">
                    <span>🍽️</span>
                    <h2>Ordered Food</h2>
                </div>

                <div class="items-list">

                    @foreach($order->items as $item)

                        <div class="order-item">

                            <div class="food-info">

                                <div class="food-icon">
                                    🍴
                                </div>

                                <div>

                                    <strong>
                                        {{ $item->food->name ?? 'Food' }}
                                    </strong>

                                    <small>
                                        TSh {{ number_format($item->price) }}
                                        × {{ $item->quantity }}
                                    </small>

                                </div>

                            </div>

                            <strong class="item-total">
                                TSh {{ number_format($item->subtotal) }}
                            </strong>

                        </div>

                    @endforeach

                </div>


                <div class="total-section">

                    <span>Total Amount</span>

                    <strong>
                        TSh {{ number_format($order->total_amount) }}
                    </strong>

                </div>

            </div>


            {{-- NOTES --}}
            <div class="info-card">

                <div class="card-title">
                    <span>📝</span>
                    <h2>Customer Notes</h2>
                </div>

                <div class="notes-box">

                    @if($order->notes)

                        {{ $order->notes }}

                    @else

                        <span class="no-notes">
                            No additional notes provided.
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>


<style>

.order-details-page {
    min-height: 100vh;
    background: #f8fafc;
    padding: 120px 20px 70px;
}

.order-details-container {
    max-width: 1100px;
    margin: auto;
}

.back-link {
    display: inline-flex;
    align-items: center;
    margin-bottom: 25px;
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
    margin-bottom: 30px;
}

.page-label {
    color: #2563eb;
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

.status-box {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 15px 20px;
}

.status {
    display: inline-flex;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-preparing {
    background: #dbeafe;
    color: #1d4ed8;
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

.success-message {
    margin-bottom: 25px;
    padding: 15px 18px;
    border-radius: 12px;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #047857;
    font-weight: 700;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}

.info-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 25px;
}

.items-card {
    grid-column: span 2;
}

.card-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
}

.card-title span {
    font-size: 24px;
}

.card-title h2 {
    margin: 0;
    color: #0f172a;
    font-size: 20px;
    font-family: 'Space Grotesk', sans-serif;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
}

.info-row:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.info-row span {
    color: #64748b;
    font-size: 14px;
}

.info-row strong {
    color: #0f172a;
    text-align: right;
    word-break: break-word;
}

.status-select {
    width: 100%;
    min-height: 48px;
    padding: 0 14px;
    margin: 8px 0 15px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    background: white;
    color: #0f172a;
    font-size: 15px;
}

.update-button {
    width: 100%;
    min-height: 48px;
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: white;
    font-weight: 800;
    cursor: pointer;
    transition: .2s;
}

.update-button:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

.items-list {
    display: flex;
    flex-direction: column;
}

.order-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 17px 0;
    border-bottom: 1px solid #f1f5f9;
}

.food-info {
    display: flex;
    align-items: center;
    gap: 13px;
}

.food-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #eff6ff;
    font-size: 22px;
}

.food-info strong {
    display: block;
    color: #0f172a;
}

.food-info small {
    display: block;
    margin-top: 4px;
    color: #64748b;
}

.item-total {
    color: #0f172a;
    white-space: nowrap;
}

.total-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e2e8f0;
}

.total-section span {
    color: #475569;
    font-weight: 700;
}

.total-section strong {
    color: #2563eb;
    font-size: 24px;
}

.notes-box {
    min-height: 80px;
    padding: 15px;
    border-radius: 12px;
    background: #f8fafc;
    color: #334155;
    line-height: 1.7;
}

.no-notes {
    color: #94a3b8;
}

@media (max-width: 750px) {

    .order-details-page {
        padding: 100px 15px 50px;
    }

    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .page-header h1 {
        font-size: 30px;
    }

    .status-box {
        width: 100%;
        box-sizing: border-box;
    }

    .details-grid {
        grid-template-columns: 1fr;
    }

    .items-card {
        grid-column: span 1;
    }

    .info-card {
        padding: 20px;
    }

    .info-row {
        flex-direction: column;
        gap: 5px;
    }

    .info-row strong {
        text-align: left;
    }

    .order-item {
        align-items: flex-start;
    }

    .total-section strong {
        font-size: 20px;
    }

}

</style>

@endsection