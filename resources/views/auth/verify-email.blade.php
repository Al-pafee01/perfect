@extends('layouts.app')

@section('title', 'Verify Email - Kessy Brothers Food')

@section('content')
<section class="verification-page">
    <div class="verification-card">
        <img src="{{ asset('images/kessy-tech-pro-logo.png') }}" alt="Kessy Tech Pro logo">
        <h1>Verify your email</h1>
        <p>
            We sent a verification link to <strong>{{ auth()->user()->email }}</strong>.
            Open that email and follow the link before ordering or accessing your account.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="verification-message" role="status">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        @if ($errors->any())
            <div class="verification-error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Resend verification email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="verification-logout" type="submit">Log out</button>
        </form>
    </div>
</section>

<style>
    .verification-page {
        min-height: calc(100vh - 150px);
        display: grid;
        place-items: center;
        padding: 48px 20px;
        background:
            radial-gradient(circle at top right, rgba(32, 169, 212, .12), transparent 36%),
            linear-gradient(145deg, #f8fafc, #eef4f7);
    }

    .verification-card {
        width: min(100%, 520px);
        padding: 42px;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 24px 70px rgba(17, 27, 43, .12);
        text-align: center;
    }

    .verification-card img {
        width: 76px;
        height: 76px;
        object-fit: contain;
        margin: 0 auto 18px;
    }

    .verification-card h1 {
        margin: 0 0 12px;
        color: var(--brand-primary);
        font-size: clamp(27px, 5vw, 36px);
    }

    .verification-card p {
        margin: 0 0 24px;
        color: #526174;
        line-height: 1.75;
        overflow-wrap: anywhere;
    }

    .verification-message,
    .verification-error {
        margin-bottom: 18px;
        padding: 12px 14px;
        border-radius: 10px;
        text-align: left;
    }

    .verification-message {
        color: #166534;
        background: #dcfce7;
    }

    .verification-error {
        color: #991b1b;
        background: #fee2e2;
    }

    .verification-card form + form {
        margin-top: 12px;
    }

    .verification-card button {
        width: 100%;
        padding: 13px 18px;
        border: 0;
        border-radius: 10px;
        background: var(--brand-secondary);
        color: var(--brand-primary);
        font: inherit;
        font-weight: 800;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .verification-card button:hover {
        background: var(--brand-secondary-dark);
        transform: translateY(-1px);
    }

    .verification-card .verification-logout {
        border: 1px solid #d7e0e8;
        background: transparent;
        color: var(--brand-primary);
    }
</style>
@endsection
