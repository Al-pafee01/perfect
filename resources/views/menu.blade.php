@extends('layouts.app')

@section('content')

<style>
    .menu-page {
        background: #f8fafc;
        min-height: 100vh;
    }

    .menu-hero {
        min-height: 55vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        background:
            linear-gradient(rgba(15, 23, 42, .72), rgba(15, 23, 42, .72)),
            url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1800&q=85')
            center/cover;
        color: white;
        padding: 120px 20px 80px;
    }

    .menu-hero h1 {
        font-size: clamp(2.5rem, 6vw, 5rem);
        margin-bottom: 18px;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 800;
    }

    .menu-hero p {
        max-width: 700px;
        margin: auto;
        font-size: 1.1rem;
        color: #e2e8f0;
        line-height: 1.8;
    }

    .menu-container {
        max-width: 1250px;
        margin: auto;
        padding: 80px 20px;
    }

    .menu-filters {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 50px;
    }

    .menu-filters input,
    .menu-filters select {
        min-height: 46px;
        min-width: 150px;
        padding: 10px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        background: white;
        color: #102033;
        font: inherit;
    }

    .menu-filters input:focus,
    .menu-filters select:focus {
        outline: 3px solid rgba(32, 169, 212, .2);
        border-color: var(--brand-accent);
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .menu-filters input,
    .menu-filters select {
        min-height: 46px;
        min-width: 150px;
        padding: 10px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        background: white;
        color: #102033;
        font: inherit;
    }

    .menu-filters input:focus,
    .menu-filters select:focus {
        outline: 3px solid rgba(41, 184, 218, .2);
        border-color: #29b8da;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .filter-btn {
        border: none;
        background: white;
        color: #334155;
        padding: 12px 25px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 700;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .08);
        transition: .3s;
        text-decoration: none;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #f0a51a;
        color: #102033;
        transform: translateY(-2px);
    }

    .menu-login-note {
        margin: -28px 0 32px;
        color: #526174;
        text-align: center;
    }

    .menu-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin: 32px 0;
        color: #526174;
    }

    .menu-pagination a {
        padding: 9px 14px;
        border-radius: 10px;
        background: var(--brand-primary);
        color: white;
        text-decoration: none;
        font-weight: 700;
    }

    .food-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .food-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(15, 23, 42, .08);
        transition: .35s;
    }

    .food-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(15, 23, 42, .14);
    }

    .food-image {
        height: 240px;
        position: relative;
        overflow: hidden;
    }

    .food-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s;
    }

    .food-card:hover .food-image img {
        transform: scale(1.07);
    }

    .food-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #f0a51a;
        color: var(--brand-primary);
        padding: 7px 14px;
        border-radius: 30px;
        font-size: .8rem;
        font-weight: 700;
    }

    .food-content {
        padding: 25px;
    }

    .food-content h3 {
        margin: 0 0 10px;
        font-size: 1.35rem;
        color: #0f172a;
    }

    .food-content p {
        color: #64748b;
        line-height: 1.7;
        min-height: 55px;
    }

    .food-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
    }

    .food-price {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--brand-secondary);
    }

    .order-btn {
        text-decoration: none;
        background: #0f172a;
        color: white;
        padding: 11px 18px;
        border-radius: 12px;
        font-weight: 700;
        transition: .3s;
    }

    .order-btn:hover {
        background: var(--brand-secondary);
        color: white;
    }

    .empty-menu {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
        color: #64748b;
    }

    .menu-cta {
        margin-top: 80px;
        padding: 60px 30px;
        border-radius: 30px;
        text-align: center;
        color: white;
        background:
            linear-gradient(rgba(15, 23, 42, .82), rgba(15, 23, 42, .82)),
            url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=1600&q=85')
            center/cover;
    }

    .menu-cta h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        margin-bottom: 15px;
    }

    .menu-cta p {
        color: #cbd5e1;
        margin-bottom: 25px;
    }

    .cta-btn {
        display: inline-block;
        text-decoration: none;
        background: var(--brand-secondary);
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 800;
        transition: .3s;
    }

    .cta-btn:hover {
        transform: translateY(-3px);
        background: #d88c08;
    }

    @media (max-width: 950px) {
        .food-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 650px) {
        .food-grid {
            grid-template-columns: 1fr;
        }

        .menu-container {
            padding: 55px 15px;
        }

        .food-image {
            height: 220px;
        }

        .menu-filters {
            align-items: stretch;
        }

        .menu-filters input,
        .menu-filters select,
        .menu-filters .filter-btn {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
    }
</style>

<div class="menu-page">

    <!-- HERO -->
    <section class="menu-hero">
        <div>
            <h1>Discover Our Delicious Menu</h1>
            <p>
                Fresh ingredients, delicious flavors and carefully prepared meals
                made to give you an unforgettable dining experience.
            </p>
        </div>
    </section>

    <!-- MENU -->
    <section class="menu-container">

        <!-- FILTERS -->
        <form class="menu-filters" method="GET" action="{{ route('menu') }}">

            <label class="sr-only" for="menu-search">Search meals</label>
            <input
                id="menu-search"
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search meals..."
                aria-label="Search meals"
            >

            <label class="sr-only" for="menu-category">Category</label>
            <select id="menu-category" name="category" aria-label="Filter by category">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>

            <label class="sr-only" for="menu-max-price">Maximum price in TSh</label>
            <input
                id="menu-max-price"
                type="number"
                name="max_price"
                min="0"
                step="500"
                value="{{ request('max_price') }}"
                placeholder="Max price (TSh)"
            >

            <button class="filter-btn active" type="submit">Find meals</button>
            <a class="filter-btn" href="{{ route('menu') }}">Clear</a>
        </form>

        @guest
            <p class="menu-login-note">
                Sign in or create an account when you are ready to order. Your order is placed after you log in.
            </p>
        @endguest


        <!-- FOOD GRID -->

        @if($foods->count() > 0)

            <div class="food-grid" id="foodGrid">

                @foreach($foods as $food)

                    <article
                        class="food-card"
                        data-category="{{ strtolower($food->category) }}"
                    >

                        <div class="food-image">

                            <img
                                src="{{ $food->image_url }}"
                                alt="{{ $food->name }}"
                            >

                            <span class="food-tag">
                                {{ ucfirst($food->category) }}
                            </span>

                        </div>


                        <div class="food-content">

                            <h3>
                                {{ $food->name }}
                            </h3>

                            <p>
                                {{ $food->description ?: 'Freshly prepared with care using quality ingredients.' }}
                            </p>


                            <div class="food-bottom">

                                <span class="food-price">
                                    TSh {{ number_format($food->price) }}
                                </span>

                                <a
                                    href="{{ url('/order') }}"
                                    class="order-btn"
                                >
                                    Order Food
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="empty-menu">
                <h2>No meals available</h2>
                <p>
                    Our menu is currently being updated. Please check again soon.
                </p>
            </div>

        @endif

        @if($foods->hasPages())
            <nav class="menu-pagination" aria-label="Menu pages">
                <span>Page {{ $foods->currentPage() }} of {{ $foods->lastPage() }}</span>
                @if($foods->previousPageUrl())
                    <a href="{{ $foods->previousPageUrl() }}" rel="prev">Previous</a>
                @endif
                @if($foods->nextPageUrl())
                    <a href="{{ $foods->nextPageUrl() }}" rel="next">Next</a>
                @endif
            </nav>
        @endif

        <!-- CTA -->

        <div class="menu-cta">

            <h2>Ready for a delicious meal?</h2>

            <p>
                Choose your favorite meal and place your order today.
            </p>

            <a href="{{ url('/order') }}" class="cta-btn">
                Order Food
            </a>

        </div>

    </section>

</div>


@endsection