@extends('layouts.app')

@section('title', 'Kessy Brothers Food | Taste Something Great')
@section('description', 'Fresh meals, delicious flavors and friendly service from Kessy Brothers Food.')

@section('content')

<style>
    .food-page {
        font-family: 'Inter', sans-serif;
        color: #171717;
        overflow: hidden;
    }

    /* ================= PROMO MARQUEE ================= */

    .food-marquee {
        position: relative;
        overflow: hidden;
        padding: 19px 0;
        border-top: 1px solid rgba(168, 225, 239, .16);
        border-bottom: 1px solid rgba(168, 225, 239, .16);
        background:
            radial-gradient(ellipse at 50% 0, rgba(32, 169, 212, .16), transparent 58%),
            linear-gradient(100deg, #0b1220, #111b2b 50%, #0b1220);
        color: #ffffff;
    }

    .food-marquee-track {
        display: flex;
        width: max-content;
        animation: foodMarquee 38s linear infinite;
        will-change: transform;
    }

    .food-marquee:hover .food-marquee-track,
    .food-marquee:focus-within .food-marquee-track {
        animation-play-state: paused;
    }

    .food-marquee-group {
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        gap: 32px;
        padding-right: 32px;
        white-space: nowrap;
    }

    .food-marquee-item {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.7px;
        text-transform: uppercase;
    }

    .food-marquee-item::after {
        width: 7px;
        height: 7px;
        border-radius: 2px;
        background: var(--brand-accent);
        box-shadow: 0 0 14px rgba(32, 169, 212, .55);
        content: "";
        transform: rotate(45deg);
    }

    .food-marquee-item:nth-child(2n)::after {
        background: var(--brand-secondary);
        box-shadow: 0 0 14px rgba(243, 154, 30, .45);
    }

    @keyframes foodMarquee {
        to {
            transform: translateX(-50%);
        }
    }

    /* ================= SECTION DIVIDERS ================= */

    .food-section-divider {
        position: relative;
        width: min(1150px, 92%);
        height: 1px;
        margin: 0 auto;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(17, 27, 43, .12) 15%,
            rgba(32, 169, 212, .36) 50%,
            rgba(17, 27, 43, .12) 85%,
            transparent
        );
    }

    .food-section-divider::before,
    .food-section-divider::after {
        position: absolute;
        top: 50%;
        left: 50%;
        content: "";
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .food-section-divider::before {
        width: 13px;
        height: 13px;
        border: 2px solid #ffffff;
        border-radius: 3px;
        background: var(--brand-secondary);
        box-shadow: 0 0 0 5px rgba(243, 154, 30, .12);
    }

    .food-section-divider::after {
        width: 5px;
        height: 5px;
        border-radius: 1px;
        background: var(--brand-accent);
        transform: translate(9px, -50%) rotate(45deg);
    }

    @media (prefers-reduced-motion: reduce) {
        .food-marquee-track {
            animation: none;
            width: 100%;
            justify-content: center;
        }

        .food-marquee-group {
            flex: 1 1 auto;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0 20px;
            white-space: normal;
        }

        .food-marquee-group[aria-hidden="true"] {
            display: none;
        }
    }

    /* ================= HERO ================= */

    .food-hero {
        min-height: 760px;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #111;
    }

    .food-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transform: scale(1.06);
        animation: foodSlider 24s infinite;
    }

        .food-slide:nth-child(1) {
        background-image: url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=2200&q=90');
    }

    .food-slide:nth-child(2) {
        background-image: url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=2200&q=90');
        animation-delay: 6s;
    }

    .food-slide:nth-child(3) {
        background-image: url('https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=2200&q=90');
        animation-delay: 12s;
    }

    .food-slide:nth-child(4) {
        background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=2200&q=90');
        animation-delay: 18s;
    }

    @keyframes foodSlider {

        0% {
            opacity: 0;
            transform: scale(1.06);
        }

        8% {
            opacity: 1;
        }

        25% {
            opacity: 1;
            transform: scale(1);
        }

        33% {
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    /* Strong overlay for readable text */

    .food-overlay {
        position: absolute;
        inset: 0;
        z-index: 1;

        background:
            linear-gradient(
                90deg,
                rgba(0,0,0,.90) 0%,
                rgba(0,0,0,.72) 38%,
                rgba(0,0,0,.45) 70%,
                rgba(0,0,0,.30) 100%
            );
    }

    .food-hero-content {
        position: relative;
        z-index: 5;
        width: min(1180px, 92%);
        margin: auto;
        padding: 120px 0 100px;
    }

    /* Badge */

    .food-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;

        padding: 10px 18px;

        border-radius: 50px;

        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25);

        backdrop-filter: blur(12px);

        color: #fff;

        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;

        margin-bottom: 28px;
    }

    .food-badge-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: var(--brand-secondary);
        box-shadow: 0 0 15px var(--brand-secondary);
    }

    /* Main heading */

    .food-hero-title {
        max-width: 850px;

        margin: 0;

        font-family: 'Space Grotesk', sans-serif;

        font-size: clamp(52px, 7vw, 92px);

        line-height: .98;

        letter-spacing: -3px;

        font-weight: 800;

        color: #ffffff;

        text-shadow:
            0 4px 25px rgba(0,0,0,.35);
    }

    .food-hero-title .orange {
        color: var(--brand-secondary);
        display: block;
    }

    /* Paragraph */

    .food-hero-description {
        max-width: 610px;

        margin: 28px 0 35px;

        color: #f1f1f1;

        font-size: 18px;

        line-height: 1.8;

        text-shadow: 0 2px 12px rgba(0,0,0,.5);
    }

    /* Buttons */

    .food-buttons {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .food-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 52px;

        padding: 0 24px;

        border-radius: 12px;

        text-decoration: none;

        font-size: 14px;
        font-weight: 800;

        transition: .3s ease;
    }

    .food-btn-primary {
        background: linear-gradient(135deg, var(--brand-secondary) 0%, var(--brand-secondary-dark) 100%);
        color: #101828;

        box-shadow:
            0 15px 35px rgba(243, 154, 30,.30);
    }

    .food-btn-primary:hover {
        transform: translateY(-4px);
        background: linear-gradient(135deg, var(--brand-secondary-dark) 0%, var(--brand-secondary-deep) 100%);
        color: #101828;
    }

    .food-btn-secondary {
        color: white;

        background: rgba(255,255,255,.08);

        border: 1px solid rgba(243, 154, 30,.55);

        backdrop-filter: blur(10px);
    }

    .food-btn-secondary:hover {
        background: rgba(243, 154, 30,.14);
        color: #f8f5ee;

        transform: translateY(-4px);
    }

    /* Hero bottom information */

    .food-hero-info {
        position: absolute;

        z-index: 5;

        bottom: 45px;

        left: 50%;

        transform: translateX(-50%);

        width: min(1180px,92%);

        display: flex;

        justify-content: space-between;

        align-items: center;

        color: white;
    }

    .food-mini-info {
        display: flex;
        gap: 30px;
    }

    .food-mini-info-item {
        display: flex;
        align-items: center;
        gap: 9px;

        font-size: 12px;

        color: rgba(255,255,255,.85);
    }

    .food-mini-info-item strong {
        color: white;
    }

    .food-scroll {
        font-size: 10px;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: .7;
    }


    /* ================= GENERAL ================= */

    .food-section {
        padding: 110px 0;
    }

    .food-container {
        width: min(1150px,92%);
        margin: auto;
    }

    .food-label {
        color: var(--brand-secondary);

        font-size: 12px;

        font-weight: 800;

        letter-spacing: 2px;

        text-transform: uppercase;

        margin-bottom: 14px;
    }

    .food-title {
        font-family: 'Space Grotesk', sans-serif;

        font-size: clamp(36px,5vw,62px);

        line-height: 1.05;

        letter-spacing: -2px;

        margin: 0;
    }


    /* ================= INTRO ================= */

    .food-intro {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 70px;

        align-items: center;
    }

    .food-intro-text p {
        color: #666;

        font-size: 17px;

        line-height: 1.9;

        margin-top: 25px;
    }

    .food-highlight {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 15px;

        margin-top: 30px;
    }

    .food-highlight-box {
        padding: 22px;

        border-radius: 18px;

        background: #fff5f1;
    }

    .food-highlight-box strong {
        display: block;

        font-size: 28px;

        color: var(--brand-secondary);

        margin-bottom: 5px;
    }

    .food-highlight-box span {
        color: #666;

        font-size: 13px;
    }

    .food-intro-image {
        min-height: 480px;

        border-radius: 30px;

        background:
            url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=1200&q=90')
            center/cover;

        box-shadow: 0 30px 70px rgba(0,0,0,.12);
    }


    /* ================= CATEGORIES ================= */

    .food-categories {
        background: #fafafa;
    }

    .food-heading-row {
        display: flex;

        justify-content: space-between;

        align-items: end;

        gap: 40px;

        margin-bottom: 45px;
    }

    .food-heading-row p {
        max-width: 500px;

        color: #666;

        line-height: 1.8;
    }

    .category-grid {
        display: grid;

        grid-template-columns: repeat(4,1fr);

        gap: 20px;
    }

    .category-card {
        position: relative;

        min-height: 250px;

        border-radius: 24px;

        overflow: hidden;

        background-size: cover;

        background-position: center;

        transition: .4s;
    }

    .category-card:hover {
        transform: translateY(-8px);
    }

    .category-card::after {
        content: "";

        position: absolute;

        inset: 0;

        background:
            linear-gradient(
                transparent 20%,
                rgba(0,0,0,.85)
            );
    }

    .category-content {
        position: absolute;

        z-index: 2;

        left: 25px;

        bottom: 25px;

        color: white;
    }

    .category-content h3 {
        margin: 0 0 5px;

        font-size: 24px;
    }

    .category-content p {
        margin: 0;

        color: #ddd;

        font-size: 13px;
    }

    .cat-1 {
        background-image:
            url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=900&q=85');
    }

    .cat-2 {
        background-image:
            url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=900&q=85');
    }

    .cat-3 {
        background-image:
            url('https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=900&q=85');
    }

    .cat-4 {
        background-image:
            url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=900&q=85');
    }


    /* ================= FOOD CARDS ================= */

    .food-products {
        display: grid;

        grid-template-columns: repeat(3,1fr);

        gap: 25px;

        margin-top: 45px;
    }

    .food-card {
        overflow: hidden;

        background: white;

        border: 1px solid #eee;

        border-radius: 24px;

        transition: .35s;
    }

    .food-card:hover {
        transform: translateY(-8px);

        box-shadow: 0 25px 60px rgba(0,0,0,.10);
    }

    .food-card-image {
        position: relative;
        height: 260px;
        overflow: hidden;
    }

    .food-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease;
    }

    .food-card:hover .food-card-image img {
        transform: scale(1.05);
    }

    .food-card-body {
        padding: 25px;
    }

    .food-card-body h3 {
        margin: 0 0 8px;

        font-size: 23px;
    }

    .food-card-body p {
        color: #777;

        line-height: 1.6;
    }

    .food-price {
        display: flex;

        justify-content: space-between;

        align-items: center;

        margin-top: 20px;
    }

    .food-price strong {
        color: var(--brand-secondary);

        font-size: 20px;
    }

    .order-small {
        padding: 10px 16px;

        border-radius: 10px;

        background: #171717;

        color: white;

        text-decoration: none;

        font-size: 13px;

        font-weight: 700;
    }

    .order-small:hover {
        background: var(--brand-secondary);

        color: white;
    }

    /* ================= FOOD GALLERY ================= */

    .gallery-section {
        padding: 110px 0;
        background: linear-gradient(180deg, #f7f4ec 0%, #ffffff 100%);
    }

    .gallery-header {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 30px;
        margin-bottom: 35px;
    }

    .gallery-header p {
        max-width: 520px;
        color: #5f6470;
        line-height: 1.8;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .gallery-card {
        position: relative;
        min-height: 360px;
        border-radius: 26px;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.12);
    }

    .gallery-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15,23,42,0.08), rgba(15,23,42,0.8));
    }

    .gallery-card:nth-child(1) {
        background-image: url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=900&q=85');
    }

    .gallery-card:nth-child(2) {
        background-image: url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=900&q=85');
    }

    .gallery-card:nth-child(3) {
        background-image: url('https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=900&q=85');
    }

    .gallery-card:nth-child(4) {
        background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=900&q=85');
    }

    .gallery-content {
        position: absolute;
        z-index: 1;
        left: 22px;
        right: 22px;
        bottom: 22px;
        color: white;
    }

    .gallery-tag {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(243, 154, 30,0.2);
        border: 1px solid rgba(243, 154, 30,0.5);
        color: #f8f5ee;
        font-size: 11px;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .gallery-content h3 {
        margin: 0;
        font-size: 26px;
        line-height: 1.1;
    }

    .gallery-content p {
        margin-top: 8px;
        color: rgba(255,255,255,0.8);
        font-size: 13px;
    }

    /* ================= STATS ================= */

    .food-stats {
        padding: 75px 0;

        background: #171717;

        color: white;
    }

    .stats-grid {
        display: grid;

        grid-template-columns: repeat(4,1fr);

        gap: 30px;

        text-align: center;
    }

    .stat-number {
        font-family: 'Space Grotesk', sans-serif;

        font-size: 45px;

        font-weight: 800;

        color: var(--brand-secondary);
    }

    .stat-label {
        color: #aaa;

        margin-top: 5px;
    }


    /* ================= CTA ================= */

    .food-cta {
        padding: 110px 0;
    }

    .cta-box {
        padding: 80px;

        border-radius: 35px;

        color: white;

        background:
            linear-gradient(
                rgba(0,0,0,.72),
                rgba(0,0,0,.72)
            ),
            url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=1800&q=90')
            center/cover;
    }

    .cta-box h2 {
        max-width: 700px;

        font-family: 'Space Grotesk', sans-serif;

        font-size: clamp(38px,5vw,65px);

        line-height: 1;

        margin: 0 0 20px;
    }

    .cta-box p {
        max-width: 600px;

        color: #ddd;

        line-height: 1.8;

        margin-bottom: 30px;
    }


    /* ================= MOBILE ================= */

    @media(max-width: 950px) {

        .food-intro {
            grid-template-columns: 1fr;
        }

        .category-grid,
        .gallery-grid {
            grid-template-columns: repeat(2,1fr);
        }

        .food-products {
            grid-template-columns: 1fr 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2,1fr);
        }

    }

    @media(max-width: 650px) {

        .food-hero {
            min-height: 720px;
        }

        .food-hero-content {
            padding-top: 100px;
        }

        .food-hero-title {
            font-size: 50px;

            letter-spacing: -2px;
        }

        .food-hero-description {
            font-size: 16px;

            line-height: 1.7;
        }

        .food-hero-info {
            display: none;
        }

        .food-section {
            padding: 75px 0;
        }

        .food-heading-row,
        .gallery-header {
            display: block;
        }

        .category-grid,
        .gallery-grid,
        .food-products {
            grid-template-columns: 1fr;
        }

        .food-intro-image {
            min-height: 350px;
        }

        .cta-box {
            padding: 45px 25px;
        }
    }
</style>


<div class="food-page">

    <!-- ================= HERO ================= -->

    <section class="food-hero">

        <div class="food-slide"></div>
        <div class="food-slide"></div>
        <div class="food-slide"></div>
        <div class="food-slide"></div>

        <div class="food-overlay"></div>

        <div class="food-hero-content">

            <div class="food-badge">
                <span class="food-badge-dot"></span>
                Fresh • Delicious • Made With Care
            </div>

            <h1 class="food-hero-title">

                Taste something great.

                <span class="orange">
                    Enjoy every bite.
                </span>

            </h1>

            <p class="food-hero-description">

                Welcome to <strong>Kessy Brothers Food</strong> —
                where fresh ingredients, bold flavors and satisfying meals come together.

            </p>

            <div class="food-buttons">

                <!-- Explore Menu -->

                <a href="{{ url('/menu') }}"
                   class="food-btn food-btn-primary">

                    🍽️ Explore Menu

                </a>


                <!-- Order Food -->

                <a href="{{ url('/order') }}"
                   class="food-btn food-btn-secondary">

                    Order Food →

                </a>

            </div>

        </div>


        <div class="food-hero-info">

            <div class="food-mini-info">

                <div class="food-mini-info-item">
                    🍳 <strong>Freshly Prepared</strong>
                </div>

                <div class="food-mini-info-item">
                    ⭐ <strong>Quality Ingredients</strong>
                </div>

                <div class="food-mini-info-item">
                    ❤️ <strong>Made With Care</strong>
                </div>

            </div>

            <div class="food-scroll">
                Scroll ↓
            </div>

        </div>

    </section>

    <div class="food-marquee" role="region" aria-label="What makes Kessy special">
        <div class="food-marquee-track">
            <div class="food-marquee-group">
                <span class="food-marquee-item">Freshly prepared with care</span>
                <span class="food-marquee-item">Flavour in every bite</span>
                <span class="food-marquee-item">Quality ingredients, always</span>
                <span class="food-marquee-item">Your next favourite meal</span>
                <span class="food-marquee-item">Made fresh, made for you</span>
            </div>
            <div class="food-marquee-group" aria-hidden="true">
                <span class="food-marquee-item">Freshly prepared with care</span>
                <span class="food-marquee-item">Flavour in every bite</span>
                <span class="food-marquee-item">Quality ingredients, always</span>
                <span class="food-marquee-item">Your next favourite meal</span>
                <span class="food-marquee-item">Made fresh, made for you</span>
            </div>
        </div>
    </div>

    <!-- ================= INTRO ================= -->

    <section class="food-section">

        <div class="food-container">

            <div class="food-intro">

                <div class="food-intro-text">

                    <div class="food-label">
                        01 — Welcome
                    </div>

                    <h2 class="food-title">
                        Great meals begin with the right ingredients.
                    </h2>

                    <p>
                        At Kessy Brothers Food, we believe every meal should be
                        fresh, flavorful and satisfying. We prepare food with care
                        so every order feels worth coming back for.
                    </p>

                    <div class="food-highlight">

                        <div class="food-highlight-box">

                            <strong>100%</strong>

                            <span>
                                Fresh Ingredients
                            </span>

                        </div>

                        <div class="food-highlight-box">

                            <strong>24/7</strong>

                            <span>
                                Friendly Service
                            </span>

                        </div>

                    </div>

                </div>

                <div class="food-intro-image"></div>

            </div>

        </div>

    </section>

    <div class="food-section-divider" aria-hidden="true"></div>

    <!-- ================= CATEGORIES ================= -->

    <section class="food-section food-categories">

        <div class="food-container">

            <div class="food-heading-row">

                <div>

                    <div class="food-label">
                        02 — Categories
                    </div>

                    <h2 class="food-title">
                        Find your next favorite.
                    </h2>

                </div>

                <p>
                    From juicy burgers to fresh pizza and perfectly
                    prepared meals, discover something delicious
                    for every craving.
                </p>

            </div>


            <div class="category-grid">

                <div class="category-card cat-1">

                    <div class="category-content">

                        <h3>
                            Burgers
                        </h3>

                        <p>
                            Juicy & delicious
                        </p>

                    </div>

                </div>


                <div class="category-card cat-2">

                    <div class="category-content">

                        <h3>
                            Pizza
                        </h3>

                        <p>
                            Fresh from the oven
                        </p>

                    </div>

                </div>


                <div class="category-card cat-3">

                    <div class="category-content">

                        <h3>
                            Grill
                        </h3>

                        <p>
                            Perfectly prepared
                        </p>

                    </div>

                </div>


                <div class="category-card cat-4">

                    <div class="category-content">

                        <h3>
                            Asian Food
                        </h3>

                        <p>
                            Rich & flavorful
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="food-section-divider" aria-hidden="true"></div>

    <!-- ================= POPULAR ================= -->

    <section class="food-section">

        <div class="food-container">

            <div class="food-label">
                03 — Popular
            </div>

            <h2 class="food-title">
            Fresh from our menu.
            </h2>

            <div class="food-products">

            @forelse($foods as $food)
                <article class="food-card">
                    <div class="food-card-image">
                        <img src="{{ $food->image_url }}" alt="{{ $food->name }}" loading="lazy">
                    </div>
                    <div class="food-card-body">
                        <h3>{{ $food->name }}</h3>
                        <p>{{ $food->description ?: 'Freshly prepared with care using quality ingredients.' }}</p>
                        <div class="food-price">
                            <strong>TSh {{ number_format($food->price) }}</strong>
                            <a href="{{ route('order') }}" class="order-small">Order</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="food-empty">
                    <p>Our menu is being prepared. Please check back soon.</p>
                    <a href="{{ route('menu') }}">Explore the menu</a>
                </div>
            @endforelse

            </div>

        </div>

    </section>

    <div class="food-section-divider" aria-hidden="true"></div>

    <!-- ================= STATS ================= -->

    <section class="food-stats">

        <div class="food-container">

            <div class="stats-grid">

                <div>

                    <div class="stat-number"
                         data-target="{{ $customerCount }}">

                        0

                    </div>

                    <div class="stat-label">
                        Happy Customers
                    </div>

                </div>


                <div>

                    <div class="stat-number"
                         data-target="{{ $mealCount }}">

                        0

                    </div>

                    <div class="stat-label">
                        Available Meals
                    </div>

                </div>


                <div>

                    <div class="stat-number"
                         data-target="{{ $categoryCount }}">

                        0

                    </div>

                    <div class="stat-label">
                        Food Categories
                    </div>

                </div>


                <div>

                    <div class="stat-number"
                         data-target="{{ $completedOrderCount }}">

                        0

                    </div>

                    <div class="stat-label">
                        Orders Completed
                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="food-section-divider" aria-hidden="true"></div>

    <!-- ================= CTA ================= -->

    <section class="food-cta">

        <div class="food-container">

            <div class="cta-box">

                <h2>
                    Ready for your next delicious meal?
                </h2>

                <p>
                    Explore our menu and find your next favorite meal.
                </p>

                <a href="{{ url('/menu') }}"
                   class="food-btn food-btn-primary">

                    Explore Menu →

                </a>

            </div>

        </div>

    </section>

</div>


<!-- ================= COUNTER SCRIPT ================= -->

<script>

    const counters = document.querySelectorAll('.stat-number');

    const observer = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if (!entry.isIntersecting) {
                return;
            }

            const counter = entry.target;

            const target = Number(
                counter.dataset.target
            );

            let current = 0;

            const update = () => {

                current += Math.ceil(target / 60);

                if (current >= target) {

                    counter.textContent = target === 0 ? '0' : target + '+';

                    return;
                }

                counter.textContent = current;

                requestAnimationFrame(update);
            };

            update();

            observer.unobserve(counter);

        });

    }, {
        threshold: 0.5
    });


    counters.forEach(counter => {

        observer.observe(counter);

    });

</script>

@endsection