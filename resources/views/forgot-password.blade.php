@extends('layouts.app')

@section('title', 'Forgot Password - Kessy Brothers Food')

@section('content')

<div class="forgot-page">

    <div class="forgot-overlay"></div>

    <div class="forgot-container">

        <div class="forgot-card">

            <div class="forgot-logo">
                <img src="{{ asset('images/kessy-tech-pro-logo.png') }}" alt="Kessy Tech Pro logo">
            </div>

            <h1>Forgot Password?</h1>

            <p class="forgot-subtitle">
                Enter your email address and we will send you instructions
                to reset your password.
            </p>

            {{-- Success Message --}}
            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                    >

                </div>

                <button type="submit" class="reset-button">
                    Send Reset Link
                </button>

            </form>

            <div class="back-login">
                Remember your password?

                <a href="{{ url('/login') }}">
                    Login
                </a>
            </div>

            <div class="back-home">
                <a href="{{ url('/') }}">
                    ← Back to Home
                </a>
            </div>

        </div>

    </div>

</div>


<style>

.forgot-page {
    min-height: 85vh;
    position: relative;

    background-image:
        url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=1800&q=85');

    background-size: cover;
    background-position: center;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 60px 20px;
}

.forgot-overlay {
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            135deg,
            rgba(2, 6, 23, 0.90),
            rgba(15, 23, 42, 0.78)
        );
}

.forgot-container {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 480px;
}

.forgot-card {
    background: rgba(255, 255, 255, 0.97);

    border-radius: 24px;

    padding: 45px 40px;

    box-shadow:
        0 25px 70px rgba(0, 0, 0, 0.35);

    text-align: center;
}

.forgot-logo {
    width: 70px;
    height: 70px;

    margin: 0 auto 20px;

    border-radius: 20px;

    background: linear-gradient(
        135deg,
        var(--brand-accent),
        #06b6d4
    );

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 32px;

    box-shadow:
        0 10px 25px rgba(32, 169, 212, 0.25);
}

.forgot-logo img {
    width: 48px;
    height: 48px;
    object-fit: contain;
}

.forgot-card h1 {
    margin: 0;

    font-size: 32px;

    color: #0f172a;

    font-weight: 800;
}

.forgot-subtitle {
    margin: 12px auto 30px;

    max-width: 360px;

    color: #64748b;

    line-height: 1.6;

    font-size: 15px;
}

.form-group {
    text-align: left;

    margin-bottom: 22px;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    font-weight: 700;

    color: #334155;

    font-size: 14px;
}

.form-group input {
    width: 100%;

    padding: 14px 16px;

    border: 1px solid #cbd5e1;

    border-radius: 12px;

    outline: none;

    font-size: 15px;

    transition: 0.25s;

    box-sizing: border-box;
}

.form-group input:focus {
    border-color: var(--brand-accent);

    box-shadow:
        0 0 0 4px rgba(32, 169, 212, 0.10);
}

.reset-button {
    width: 100%;

    border: none;

    border-radius: 12px;

    padding: 15px;

    background: linear-gradient(
        135deg,
        var(--brand-accent),
        #06b6d4
    );

    color: white;

    font-size: 16px;

    font-weight: 700;

    cursor: pointer;

    transition: 0.25s;
}

.reset-button:hover {
    transform: translateY(-2px);

    box-shadow:
        0 12px 25px rgba(32, 169, 212, 0.25);
}

.success-message {
    background: #dcfce7;

    color: #166534;

    border: 1px solid #86efac;

    padding: 12px 15px;

    border-radius: 10px;

    margin-bottom: 20px;

    font-size: 14px;
}

.error-message {
    background: #fee2e2;

    color: #991b1b;

    border: 1px solid #fca5a5;

    padding: 12px 15px;

    border-radius: 10px;

    margin-bottom: 20px;

    text-align: left;

    font-size: 14px;
}

.back-login {
    margin-top: 25px;

    color: #64748b;

    font-size: 14px;
}

.back-login a {
    color: var(--brand-accent);

    font-weight: 700;

    text-decoration: none;
}

.back-login a:hover {
    text-decoration: underline;
}

.back-home {
    margin-top: 18px;
}

.back-home a {
    color: #475569;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;
}

.back-home a:hover {
    color: var(--brand-accent);
}


/* Mobile */

@media (max-width: 600px) {

    .forgot-page {
        padding: 40px 15px;
    }

    .forgot-card {
        padding: 35px 22px;

        border-radius: 20px;
    }

    .forgot-card h1 {
        font-size: 27px;
    }

}

</style>

@endsection