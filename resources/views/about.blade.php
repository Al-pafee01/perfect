@extends('layouts.app')

@section('title', 'About Us | Kessy Brothers Food')
@section('description', 'Learn more about Kessy Brothers Food, our story, passion and commitment to fresh, delicious meals.')

@section('content')

<style>
    .about-page {
        font-family: 'Inter', sans-serif;
        background: #ffffff;
        color: #172033;
        overflow: hidden;
    }

    /* =========================
       ABOUT HERO
    ========================== */
    .about-hero {
        min-height: 72vh;
        position: relative;
        display: flex;
        align-items: center;
        background-image:
            linear-gradient(
                rgba(5, 10, 20, 0.78),
                rgba(5, 10, 20, 0.72)
            ),
            url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1800&q=85');
        background-size: cover;
        background-position: center;
        isolation: isolate;
    }

    .about-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            rgba(0, 0, 0, 0.72),
            rgba(0, 0, 0, 0.35),
            rgba(0, 0, 0, 0.65)
        );
        z-index: -1;
    }

    .about-hero-content {
        width: min(1180px, 92%);
        margin: auto;
        color: #ffffff;
        position: relative;
        z-index: 2;
    }

    .about-badge {
        display: inline-block;
        padding: 9px 17px;
        border-radius: 50px;
        background: rgba(243, 154, 30, 0.95);
        color: #ffffff;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 22px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .about-hero h1 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(42px, 7vw, 78px);
        line-height: 1.03;
        max-width: 850px;
        margin: 0 0 24px;
        color: #ffffff;
        font-weight: 800;

        /* Makes text visible on ANY background */
        text-shadow:
            0 3px 8px rgba(0,0,0,0.9),
            0 8px 25px rgba(0,0,0,0.7);
    }

    .about-hero h1 span {
        color: #ff7048;
    }

    .about-hero p {
        max-width: 680px;
        font-size: 18px;
        line-height: 1.8;
        color: #ffffff;
        margin-bottom: 32px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.9);
        font-weight: 500;
    }

    .about-hero-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .about-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 15px 25px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 800;
        transition: 0.3s ease;
    }

    .about-btn-primary {
        background: var(--brand-secondary);
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(243, 154, 30, 0.35);
    }

    .about-btn-primary:hover {
        transform: translateY(-3px);
        background: #f4512b;
    }

    .about-btn-light {
        background: rgba(255,255,255,0.13);
        border: 1px solid rgba(255,255,255,0.55);
        color: #ffffff;
        backdrop-filter: blur(8px);
    }

    .about-btn-light:hover {
        background: #ffffff;
        color: #111827;
    }


    /* =========================
       STORY SECTION
    ========================== */
    .about-story {
        padding: 100px 0;
        background: #ffffff;
    }

    .about-container {
        width: min(1150px, 92%);
        margin: auto;
    }

    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 70px;
        align-items: center;
    }

    .story-image {
        position: relative;
    }

    .story-image img {
        width: 100%;
        height: 520px;
        object-fit: cover;
        border-radius: 28px;
        display: block;
        box-shadow: 0 25px 60px rgba(15,23,42,0.15);
    }

    .story-badge {
        position: absolute;
        right: -25px;
        bottom: 30px;
        background: var(--brand-secondary);
        color: #ffffff;
        padding: 20px 24px;
        border-radius: 18px;
        font-weight: 800;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .section-label {
        color: var(--brand-secondary);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .story-content h2 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(34px, 5vw, 52px);
        line-height: 1.1;
        margin: 0 0 22px;
        color: #111827;
    }

    .story-content h2 span {
        color: var(--brand-secondary);
    }

    .story-content p {
        color: #5b6474;
        font-size: 16px;
        line-height: 1.9;
        margin-bottom: 18px;
    }


    /* =========================
       MISSION & VISION
    ========================== */
    .mission-section {
        padding: 95px 0;
        background: #f8fafc;
    }

    .section-heading {
        text-align: center;
        max-width: 720px;
        margin: 0 auto 55px;
    }

    .section-heading h2 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(34px, 5vw, 50px);
        color: #111827;
        margin: 0 0 16px;
    }

    .section-heading p {
        color: #667085;
        line-height: 1.8;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .mission-card {
        background: #ffffff;
        padding: 38px;
        border-radius: 22px;
        border: 1px solid #e5e7eb;
        transition: 0.3s ease;
        box-shadow: 0 12px 35px rgba(15,23,42,0.05);
    }

    .mission-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 20px 45px rgba(15,23,42,0.1);
    }

    .mission-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #fff0eb;
        color: var(--brand-secondary);
        font-size: 25px;
        margin-bottom: 22px;
    }

    .mission-card h3 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 24px;
        color: #111827;
        margin-bottom: 12px;
    }

    .mission-card p {
        color: #667085;
        line-height: 1.8;
        margin: 0;
    }


    /* =========================
       WHY CHOOSE US
    ========================== */
    .why-section {
        padding: 100px 0;
        background: #ffffff;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .why-card {
        padding: 32px 25px;
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid #e8ebf0;
        text-align: center;
        transition: 0.3s ease;
    }

    .why-card:hover {
        transform: translateY(-8px);
        border-color: #ffb49f;
        box-shadow: 0 18px 40px rgba(15,23,42,0.08);
    }

    .why-number {
        font-size: 13px;
        font-weight: 800;
        color: var(--brand-secondary);
        margin-bottom: 15px;
    }

    .why-card h3 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 20px;
        color: #111827;
        margin-bottom: 12px;
    }

    .why-card p {
        color: #667085;
        line-height: 1.7;
        font-size: 14px;
    }


    /* =========================
       STATS
    ========================== */
    .about-stats {
        padding: 80px 0;
        background: #111827;
        color: #ffffff;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        text-align: center;
    }

    .stat h3 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 42px;
        margin: 0 0 8px;
        color: #ff7048;
    }

    .stat p {
        margin: 0;
        color: #d1d5db;
        font-weight: 600;
    }


    /* =========================
       CTA
    ========================== */
    .about-cta {
        padding: 100px 20px;
        position: relative;
        background-image:
            linear-gradient(
                rgba(8, 12, 20, 0.84),
                rgba(8, 12, 20, 0.84)
            ),
            url('https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=1800&q=85');
        background-size: cover;
        background-position: center;
        text-align: center;
        color: #ffffff;
    }

    .about-cta h2 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(34px, 5vw, 58px);
        margin: 0 0 18px;
        color: #ffffff;
        text-shadow: 0 3px 10px rgba(0,0,0,0.9);
    }

    .about-cta p {
        max-width: 650px;
        margin: 0 auto 30px;
        color: #ffffff;
        line-height: 1.8;
        text-shadow: 0 2px 7px rgba(0,0,0,0.9);
    }


    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 900px) {

        .story-grid {
            grid-template-columns: 1fr;
            gap: 45px;
        }

        .story-image img {
            height: 420px;
        }

        .story-badge {
            right: 20px;
        }

        .mission-grid {
            grid-template-columns: 1fr;
        }

        .why-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            row-gap: 40px;
        }
    }

    @media (max-width: 600px) {

        .about-hero {
            min-height: 80vh;
        }

        .about-hero h1 {
            font-size: 43px;
        }

        .about-hero p {
            font-size: 15px;
        }

        .about-hero-buttons {
            flex-direction: column;
        }

        .about-btn {
            width: 100%;
        }

        .about-story,
        .mission-section,
        .why-section {
            padding: 70px 0;
        }

        .story-image img {
            height: 350px;
        }

        .story-badge {
            right: 10px;
            bottom: 15px;
            padding: 15px;
            font-size: 13px;
        }

        .why-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .stat h3 {
            font-size: 32px;
        }

        .about-cta {
            padding: 75px 20px;
        }
    }
</style>


<div class="about-page">

    <!-- ================= HERO ================= -->
    <section class="about-hero">

        <div class="about-hero-content">

            <span class="about-badge">
                ABOUT KESSY BROTHERS FOOD
            </span>

            <h1>
                More Than a Meal.<br>
                It's a <span>Flavor Experience.</span>
            </h1>

            <p>
                We believe great food is more than a meal.
                It brings people together and makes every moment memorable.
            </p>

            <div class="about-hero-buttons">

                <a href="#" class="about-btn about-btn-primary">
                    Explore Our Menu
                </a>

                <a href="#story" class="about-btn about-btn-light">
                    Our Story
                </a>

            </div>

        </div>

    </section>


    <!-- ================= STORY ================= -->
    <section class="about-story" id="story">

        <div class="about-container">

            <div class="story-grid">

                <div class="story-image">

                    <img
                        src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=1000&q=85"
                        alt="Freshly prepared food">

                    <div class="story-badge">
                        Fresh • Tasty • Memorable
                    </div>

                </div>


                <div class="story-content">

                    <div class="section-label">
                        OUR STORY
                    </div>

                    <h2>
                        Passion for food.
                        <span>Love for great taste.</span>
                    </h2>

                    <p>
                        Kessy Brothers Food was created with one simple idea:
                        every meal should feel fresh, satisfying and memorable.
                    </p>

                    <p>
                        From carefully selected ingredients to friendly service,
                        we focus on preparing meals that are delicious,
                        consistent and full of flavor.
                    </p>

                    <p>
                        Whether you are ordering lunch, sharing dinner,
                        or enjoying a quick bite, we are here to make your meal special.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= MISSION & VISION ================= -->
    <section class="mission-section">

        <div class="about-container">

            <div class="section-heading">

                <div class="section-label">
                    WHAT DRIVES US
                </div>

                <h2>
                    Our Mission & Vision
                </h2>

                <p>
                    Everything we do is guided by our passion for
                    quality food and memorable customer experiences.
                </p>

            </div>


            <div class="mission-grid">

                <div class="mission-card">

                    <div class="mission-icon">
                        🍽️
                    </div>

                    <h3>
                        Our Mission
                    </h3>

                    <p>
                        To provide delicious, fresh and enjoyable meals
                        while giving every customer a welcoming and
                        memorable experience.
                    </p>

                </div>


                <div class="mission-card">

                    <div class="mission-icon">
                        ✨
                    </div>

                    <h3>
                        Our Vision
                    </h3>

                    <p>
                        To build a food brand known for quality,
                        creativity, great taste and excellent customer
                        service.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= WHY US ================= -->
    <section class="why-section">

        <div class="about-container">

            <div class="section-heading">

                <div class="section-label">
                    WHY US
                </div>

                <h2>
                    Why Choose Us?
                </h2>

                <p>
                    We put attention into every part of your food
                    experience.
                </p>

            </div>


            <div class="why-grid">

                <div class="why-card">

                    <div class="why-number">
                        01
                    </div>

                    <h3>
                        Fresh Ingredients
                    </h3>

                    <p>
                        We focus on quality ingredients to create
                        delicious meals.
                    </p>

                </div>


                <div class="why-card">

                    <div class="why-number">
                        02
                    </div>

                    <h3>
                        Great Taste
                    </h3>

                    <p>
                        Every meal is prepared with attention to
                        flavour and presentation.
                    </p>

                </div>


                <div class="why-card">

                    <div class="why-number">
                        03
                    </div>

                    <h3>
                        Friendly Service
                    </h3>

                    <p>
                        We want every customer to feel welcome and
                        appreciated.
                    </p>

                </div>


                <div class="why-card">

                    <div class="why-number">
                        04
                    </div>

                    <h3>
                        Quality First
                    </h3>

                    <p>
                        Quality is at the heart of everything we
                        prepare and serve.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= STATS ================= -->
    <section class="about-stats">

        <div class="about-container">

            <div class="stats-grid">

                <div class="stat">
                    <h3>100+</h3>
                    <p>Happy Customers</p>
                </div>

                <div class="stat">
                    <h3>25+</h3>
                    <p>Delicious Meals</p>
                </div>

                <div class="stat">
                    <h3>5+</h3>
                    <p>Food Categories</p>
                </div>

                <div class="stat">
                    <h3>100%</h3>
                    <p>Passion for Food</p>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= CTA ================= -->
    <section class="about-cta">

        <h2>
            Ready for Your Next Great Meal?
        </h2>

        <p>
            Discover delicious meals prepared for comfort,
            sharing and unforgettable moments with loved ones.
        </p>

        <a href="#" class="about-btn about-btn-primary">
            Explore Our Menu
        </a>

    </section>

</div>

@endsection