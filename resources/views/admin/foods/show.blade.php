@extends('layouts.app')

@section('content')

<style>

    .food-details-page {
        min-height: 100vh;
        background: #f8fafc;
        padding: 120px 20px 80px;
    }

    .food-details-container {
        max-width: 950px;
        margin: auto;
    }

    .details-header {
        margin-bottom: 30px;
    }

    .details-header h1 {
        margin: 0;
        color: #0f172a;
        font-size: 2.3rem;
        font-weight: 800;
    }

    .details-header p {
        margin-top: 8px;
        color: #64748b;
    }

    .food-details-card {
        background: white;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(15, 23, 42, .08);
    }

    .food-details-top {
        background: linear-gradient(
            135deg,
            #0f172a,
            #1e293b
        );

        padding: 35px;

        color: white;
    }

    .food-details-top h2 {
        margin: 0 0 10px;
        font-size: 2rem;
    }

    .food-details-top p {
        margin: 0;
        color: #cbd5e1;
    }

    .details-content {
        padding: 35px;
    }

    .details-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 20px;
    }

    .detail-box {
        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 15px;

        padding: 20px;
    }

    .detail-label {
        display: block;

        color: #64748b;

        font-size: .85rem;

        font-weight: 700;

        margin-bottom: 8px;

        text-transform: uppercase;

        letter-spacing: .5px;
    }

    .detail-value {
        color: #0f172a;

        font-size: 1.05rem;

        font-weight: 700;
    }

    .description-box {
        grid-column: 1 / -1;
    }

    .description-text {
        color: #475569;

        line-height: 1.7;

        font-weight: 500;
    }

    .category-badge {
        display: inline-block;

        background: #dbeafe;

        color: var(--brand-accent);

        padding: 7px 13px;

        border-radius: 20px;

        font-size: .85rem;

        font-weight: 800;
    }

    .available-badge {
        display: inline-block;

        background: #dcfce7;

        color: #15803d;

        padding: 7px 13px;

        border-radius: 20px;

        font-size: .85rem;

        font-weight: 800;
    }

    .unavailable-badge {
        display: inline-block;

        background: #fee2e2;

        color: #dc2626;

        padding: 7px 13px;

        border-radius: 20px;

        font-size: .85rem;

        font-weight: 800;
    }

    .details-actions {
        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 15px;

        margin-top: 30px;

        padding-top: 25px;

        border-top: 1px solid #e2e8f0;
    }

    .action-group {
        display: flex;

        gap: 10px;
    }

    .details-btn {
        display: inline-block;

        text-decoration: none;

        border: none;

        padding: 12px 20px;

        border-radius: 10px;

        font-weight: 700;

        cursor: pointer;

        transition: .3s;
    }

    .back-btn {
        background: #f1f5f9;

        color: #334155;
    }

    .back-btn:hover {
        background: #e2e8f0;
    }

    .edit-btn {
        background: #eff6ff;

        color: var(--brand-accent);
    }

    .edit-btn:hover {
        background: #dbeafe;

        transform: translateY(-2px);
    }

    .delete-btn {
        background: #fef2f2;

        color: #dc2626;
    }

    .delete-btn:hover {
        background: #fee2e2;

        transform: translateY(-2px);
    }

    @media (max-width: 650px) {

        .food-details-page {
            padding: 100px 15px 60px;
        }

        .food-details-top,
        .details-content {
            padding: 25px;
        }

        .food-details-top h2 {
            font-size: 1.6rem;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .description-box {
            grid-column: auto;
        }

        .details-actions {
            flex-direction: column;

            align-items: stretch;
        }

        .action-group {
            flex-direction: column;
        }

        .details-btn {
            text-align: center;
        }
    }

</style>


<div class="food-details-page">

    <div class="food-details-container">

        <!-- HEADER -->

        <div class="details-header">

            <h1>
                Food Details
            </h1>

            <p>
                View complete information about this food.
            </p>

        </div>


        <!-- CARD -->

        <div class="food-details-card">


            <!-- TOP -->

            <div class="food-details-top">

                <h2>
                    {{ $food->name }}
                </h2>

                <p>
                    Added on
                    {{ $food->created_at->format('d M Y') }}
                </p>

            </div>


            <!-- CONTENT -->

            <div class="details-content">

                <div class="details-grid">


                    <!-- NAME -->

                    <div class="detail-box">

                        <span class="detail-label">
                            Food Name
                        </span>

                        <div class="detail-value">
                            {{ $food->name }}
                        </div>

                    </div>


                    <!-- CATEGORY -->

                    <div class="detail-box">

                        <span class="detail-label">
                            Category
                        </span>

                        <div class="detail-value">

                            <span class="category-badge">
                                {{ ucfirst($food->category) }}
                            </span>

                        </div>

                    </div>


                    <!-- PRICE -->

                    <div class="detail-box">

                        <span class="detail-label">
                            Price
                        </span>

                        <div class="detail-value">
                            TSh {{ number_format($food->price) }}
                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="detail-box">

                        <span class="detail-label">
                            Availability
                        </span>

                        <div class="detail-value">

                            @if($food->is_available)

                                <span class="available-badge">
                                    ● Available
                                </span>

                            @else

                                <span class="unavailable-badge">
                                    ● Unavailable
                                </span>

                            @endif

                        </div>

                    </div>


                    <!-- IMAGE -->

                    <div class="detail-box">

                        <span class="detail-label">
                            Image
                        </span>

                        <div class="detail-value">

                            @if($food->image)

                                {{ $food->image }}

                            @else

                                No image

                            @endif

                        </div>

                    </div>


                    <!-- ID -->

                    <div class="detail-box">

                        <span class="detail-label">
                            Food ID
                        </span>

                        <div class="detail-value">
                            #{{ $food->id }}
                        </div>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="detail-box description-box">

                        <span class="detail-label">
                            Description
                        </span>

                        <div class="description-text">

                            @if($food->description)

                                {{ $food->description }}

                            @else

                                No description available.

                            @endif

                        </div>

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="details-actions">

                    <a
                        href="{{ route('foods.index') }}"
                        class="details-btn back-btn"
                    >
                        ← Back to Foods
                    </a>


                    <div class="action-group">

                        <a
                            href="{{ route('foods.edit', $food) }}"
                            class="details-btn edit-btn"
                        >
                            ✏ Edit
                        </a>


                        <form
                            action="{{ route('foods.destroy', $food) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this food?');"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="details-btn delete-btn"
                            >
                                🗑 Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection