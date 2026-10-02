@extends('layouts.app')

@section('content')

<style>

    .admin-food-page {
        min-height: 100vh;
        background: #f8fafc;
        padding: 120px 20px 80px;
    }

    .admin-food-container {
        max-width: 1200px;
        margin: auto;
    }

    /* =========================
       HEADER
    ========================= */

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 35px;
    }

    .admin-header h1 {
        margin: 0;
        color: #0f172a;
        font-size: 2.3rem;
        font-weight: 800;
    }

    .admin-header p {
        margin-top: 8px;
        color: #64748b;
    }

    .add-food-btn {
        display: inline-block;
        background: #ff6338;
        color: white;
        text-decoration: none;
        padding: 13px 22px;
        border-radius: 12px;
        font-weight: 700;
        transition: .3s;
        white-space: nowrap;
    }

    .add-food-btn:hover {
        background: #e94f27;
        transform: translateY(-2px);
    }


    /* =========================
       SUCCESS MESSAGE
    ========================= */

    .success-message {
        background: #dcfce7;
        color: #166534;
        padding: 15px 18px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-weight: 600;
    }


    /* =========================
       TABLE
    ========================= */

    .food-table-wrapper {
        background: white;
        border-radius: 20px;
        overflow-x: auto;
        box-shadow: 0 10px 35px rgba(15, 23, 42, .08);
    }

    .food-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .food-table th {
        background: #0f172a;
        color: white;
        text-align: left;
        padding: 17px;
        font-size: .9rem;
    }

    .food-table td {
        padding: 17px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        vertical-align: middle;
    }

    .food-table tr:last-child td {
        border-bottom: none;
    }

    .food-table tbody tr {
        transition: .2s;
    }

    .food-table tbody tr:hover {
        background: #f8fafc;
    }


    /* =========================
       FOOD NAME
    ========================= */

    .food-name {
        font-weight: 800;
        color: #0f172a;
    }


    /* =========================
       CATEGORY
    ========================= */

    .category-badge {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: .8rem;
        font-weight: 700;
    }


    /* =========================
       PRICE
    ========================= */

    .food-price {
        font-weight: 800;
        color: #0f172a;
    }


    /* =========================
       STATUS
    ========================= */

    .available {
        color: #15803d;
        font-weight: 700;
    }

    .unavailable {
        color: #dc2626;
        font-weight: 700;
    }


    /* =========================
       ACTIONS
    ========================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .action-btn {
        border: none;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 9px;
        font-size: .85rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-block;
        transition: .25s;
        white-space: nowrap;
    }


    /* VIEW */

    .view-btn {
        background: #f0fdf4;
        color: #15803d;
    }

    .view-btn:hover {
        background: #dcfce7;
        transform: translateY(-2px);
    }


    /* EDIT */

    .edit-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .edit-btn:hover {
        background: #dbeafe;
        transform: translateY(-2px);
    }


    /* DELETE */

    .delete-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .delete-btn:hover {
        background: #fee2e2;
        transform: translateY(-2px);
    }


    /* =========================
       EMPTY STATE
    ========================= */

    .empty-foods {
        background: white;
        text-align: center;
        padding: 70px 20px;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, .08);
    }

    .empty-foods h2 {
        margin: 0;
        color: #0f172a;
    }

    .empty-foods p {
        color: #64748b;
        margin-top: 10px;
    }

    .empty-add-btn {
        display: inline-block;
        margin-top: 20px;
        background: #ff6338;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 700;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 700px) {

        .admin-food-page {
            padding: 105px 15px 60px;
        }

        .admin-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .admin-header h1 {
            font-size: 1.8rem;
        }

        .add-food-btn {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

    }

</style>


<div class="admin-food-page">

    <div class="admin-food-container">


        <!-- =========================
             HEADER
        ========================= -->

        <div class="admin-header">

            <div>

                <h1>
                    Food Management
                </h1>

                <p>
                    Manage all foods available on your website.
                </p>

            </div>


            <a
                href="{{ route('foods.create') }}"
                class="add-food-btn"
            >
                + Add New Food
            </a>

        </div>


        <!-- =========================
             SUCCESS MESSAGE
        ========================= -->

        @if(session('success'))

            <div class="success-message">

                ✓ {{ session('success') }}

            </div>

        @endif


        <!-- =========================
             FOODS
        ========================= -->

        @if($foods->count() > 0)


            <div class="food-table-wrapper">

                <table class="food-table">


                    <!-- TABLE HEADER -->

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Food Name
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Price
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <!-- TABLE BODY -->

                    <tbody>

                        @foreach($foods as $food)

                            <tr>


                                <!-- NUMBER -->

                                <td>

                                    {{ $loop->iteration }}

                                </td>


                                <!-- FOOD NAME -->

                                <td>

                                    <div class="food-name">

                                        {{ $food->name }}

                                    </div>

                                </td>


                                <!-- CATEGORY -->

                                <td>

                                    <span class="category-badge">

                                        {{ ucfirst($food->category) }}

                                    </span>

                                </td>


                                <!-- PRICE -->

                                <td>

                                    <span class="food-price">

                                        TSh {{ number_format($food->price) }}

                                    </span>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    @if($food->is_available)

                                        <span class="available">

                                            ● Available

                                        </span>

                                    @else

                                        <span class="unavailable">

                                            ● Unavailable

                                        </span>

                                    @endif

                                </td>


                                <!-- ACTIONS -->

                                <td>

                                    <div class="action-buttons">


                                        <!-- VIEW -->

                                        <a
                                            href="{{ route('foods.show', $food) }}"
                                            class="action-btn view-btn"
                                        >
                                            View
                                        </a>


                                        <!-- EDIT -->

                                        <a
                                            href="{{ route('foods.edit', $food) }}"
                                            class="action-btn edit-btn"
                                        >
                                            Edit
                                        </a>


                                        <!-- DELETE -->

                                        <form
                                            action="{{ route('foods.destroy', $food) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete {{ $food->name }}?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                            >
                                                Delete
                                            </button>

                                        </form>


                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @else


            <!-- EMPTY STATE -->

            <div class="empty-foods">

                <h2>
                    No Foods Found
                </h2>

                <p>
                    Start by adding your first food.
                </p>

                <a
                    href="{{ route('foods.create') }}"
                    class="empty-add-btn"
                >
                    + Add First Food
                </a>

            </div>


        @endif


    </div>

</div>

@endsection