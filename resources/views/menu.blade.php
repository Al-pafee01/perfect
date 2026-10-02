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
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #ff6338;
        color: white;
        transform: translateY(-2px);
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
        background: #ff6338;
        color: white;
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
        color: #ff6338;
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
        background: #ff6338;
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
        background: #ff6338;
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 800;
        transition: .3s;
    }

    .cta-btn:hover {
        transform: translateY(-3px);
        background: #ff4b1f;
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
        <div class="menu-filters">

            <button class="filter-btn active" data-filter="all">
                All
            </button>

            <button class="filter-btn" data-filter="burgers">
                Burgers
            </button>

            <button class="filter-btn" data-filter="pizza">
                Pizza
            </button>

            <button class="filter-btn" data-filter="pasta">
                Pasta
            </button>

            <button class="filter-btn" data-filter="grill">
                Grill
            </button>

            <button class="filter-btn" data-filter="drinks">
                Drinks
            </button>

        </div>


        <!-- FOOD GRID -->

        @if($foods->count() > 0)

            <div class="food-grid" id="foodGrid">

                @foreach($foods as $food)

                    <article
                        class="food-card"
                        data-category="{{ strtolower($food->category) }}"
                        id="{{ strtolower($food->category) }}"
                    >

                        <div class="food-image">

                            <img
                                src="{{ $food->image
                                    ? asset('images/foods/' . $food->image)
                                    : 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=900&q=80'
                                }}"
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
                                {{ $food->description }}
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


<script>
document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.food-card');

    buttons.forEach(button => {

        button.addEventListener('click', function () {

            const filter = this.dataset.filter;

            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            this.classList.add('active');

            cards.forEach(card => {

                const category = card.dataset.category;

                if (filter === 'all' || category === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }

            });

        });

    });

});
</script>

@endsection