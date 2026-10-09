@extends('layouts.app')

@section('title', 'Admin Access Only - Kessy Brothers Food')

@section('content')

<section class="access-denied-page">

    <div class="access-denied-card">

        <div class="access-denied-icon">
            <img src="{{ asset('images/kessy-tech-pro-logo.png') }}" alt="Kessy Tech Pro logo">
        </div>

        <span class="access-denied-label">ADMIN AREA</span>

        <h1>This is admin part only</h1>

        <p>
            This section is reserved for authorized Kessy Brothers Food administrators.
            You can continue browsing our menu and ordering your favorite meals.
        </p>

        <div class="access-denied-actions">
            <a href="{{ url('/menu') }}" class="access-denied-primary">
                🍽️ Go to Food Menu
            </a>

            <a href="{{ url('/') }}" class="access-denied-secondary">
                Back Home
            </a>
        </div>

    </div>

</section>

<style>

.access-denied-page {
    min-height: calc(100vh - 78px);
    display: grid;
    place-items: center;
    padding: 90px 20px;
    background:
        radial-gradient(circle at top right, rgba(243, 154, 30, .14), transparent 34%),
        #f8fafc;
}

.access-denied-card {
    width: min(560px, 100%);
    padding: 52px 38px;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    background: rgba(255, 255, 255, .94);
    box-shadow: 0 24px 70px rgba(15, 23, 42, .12);
    text-align: center;
}

.access-denied-icon {
    width: 76px;
    height: 76px;
    display: grid;
    place-items: center;
    margin: 0 auto 22px;
    border-radius: 22px;
    background: #fff1eb;
}

.access-denied-icon img {
    width: 48px;
    height: 48px;
    object-fit: contain;
}

.access-denied-label {
    color: var(--brand-secondary);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 2px;
}

.access-denied-card h1 {
    margin: 12px 0 14px;
    color: #0f172a;
    font-size: clamp(30px, 5vw, 46px);
    line-height: 1.08;
}

.access-denied-card p {
    max-width: 440px;
    margin: 0 auto;
    color: #64748b;
    line-height: 1.8;
}

.access-denied-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 30px;
}

.access-denied-actions a {
    padding: 13px 18px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 800;
    text-decoration: none;
    transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
}

.access-denied-actions a:hover {
    transform: translateY(-2px);
}

.access-denied-primary {
    background: var(--brand-secondary);
    color: #ffffff;
    box-shadow: 0 10px 24px rgba(243, 154, 30, .24);
}

.access-denied-secondary {
    border: 1px solid #cbd5e1;
    color: #334155;
    background: #ffffff;
}

@media (max-width: 520px) {
    .access-denied-card {
        padding: 40px 22px;
    }
}

</style>

@endsection
