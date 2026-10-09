@extends('layouts.app')

@section('title', 'Create Account - Kessy Brothers Food')

@section('content')

<div class="register-page">

    <div class="register-overlay"></div>

    <div class="register-container">

        <div class="register-card">

            <div class="register-logo">
                <img src="{{ asset('images/kessy-tech-pro-logo.png') }}" alt="Kessy Tech Pro logo">
            </div>

            <h1>Create Account</h1>

            <p class="register-subtitle">
                Join Kessy Brothers Food and start ordering your favorite meals. We record sign-in time, device and IP for account security.
            </p>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="error-message">
                    <strong>Please fix the following:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">

                @csrf

                {{-- Name --}}
                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        required
                    >

                </div>


                {{-- Email --}}
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


                {{-- Gender --}}
                <div class="form-group">

                    <label for="gender">
                        Gender
                    </label>

                    <select
                        id="gender"
                        name="gender"
                        required
                    >
                        <option value="" disabled @selected(old('gender') === null)>Select gender</option>
                        <option value="female" @selected(old('gender') === 'female')>Female</option>
                        <option value="male" @selected(old('gender') === 'male')>Male</option>
                        <option value="prefer_not_to_say" @selected(old('gender') === 'prefer_not_to_say')>Prefer not to say</option>
                    </select>

                </div>


                {{-- Phone Number --}}
                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="e.g. +255 712 345 678"
                        autocomplete="tel"
                        maxlength="32"
                        required
                    >

                </div>


                {{-- Password --}}
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Create a password"
                            required
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password', 'passwordIcon')"
                            class="password-toggle"
                        >
                            <span id="passwordIcon">👁</span>
                        </button>

                    </div>

                </div>


                {{-- Confirm Password --}}
                <div class="form-group">

                    <label for="password_confirmation">
                        Confirm Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            required
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', 'confirmIcon')"
                            class="password-toggle"
                        >
                            <span id="confirmIcon">👁</span>
                        </button>

                    </div>

                </div>


                {{-- Register Button --}}
                <button type="submit" class="register-button">
                    Create Account
                </button>

            </form>


            <div class="login-link">

                Already have an account?

                <a href="{{ url('/login') }}">
                    Login
                </a>

            </div>

        </div>

    </div>

</div>


<style>

.register-page {
    min-height: calc(100vh - 80px);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;

    background-image:
        url('https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=1800&q=85');

    background-size: cover;
    background-position: center;
    padding: 60px 20px;
}

.register-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.65);
}

.register-container {
    width: 100%;
    max-width: 520px;
    position: relative;
    z-index: 2;
}

.register-card {
    background: rgba(255, 255, 255, 0.97);
    padding: 40px;
    border-radius: 24px;
    box-shadow: 0 25px 70px rgba(0,0,0,0.35);
}

.register-logo {
    width: 150px;
    height: 115px;

    margin: 0 auto 15px;

    display: flex;
    align-items: center;
    justify-content: center;

}

.register-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.register-card h1 {
    text-align: center;
    margin: 0;

    color: #0f172a;

    font-family: "Space Grotesk", sans-serif;

    font-size: 32px;
}

.register-subtitle {
    text-align: center;

    color: #64748b;

    margin: 10px 0 30px;

    line-height: 1.6;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    font-weight: 600;

    color: #0f172a;
}

.form-group input {
    width: 100%;

    padding: 14px 15px;

    border: 1px solid #cbd5e1;

    border-radius: 12px;

    font-size: 16px;

    outline: none;

    transition: 0.3s;

    box-sizing: border-box;
}

.form-group select {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    outline: none;
    background: #ffffff;
    font-size: 15px;
    box-sizing: border-box;
}

.form-group select:focus {
    border-color: var(--brand-accent);
    box-shadow: 0 0 0 4px rgba(32, 169, 212, 0.10);
}

.form-group input:focus {
    border-color: var(--brand-accent);

    box-shadow:
        0 0 0 3px rgba(32, 169, 212, 0.12);
}

.password-wrapper {
    position: relative;
}

.password-wrapper input {
    padding-right: 50px;
}

.password-toggle {
    position: absolute;

    right: 10px;
    top: 50%;

    transform: translateY(-50%);

    border: none;

    background: transparent;

    cursor: pointer;

    font-size: 18px;
}

.register-button {
    width: 100%;

    border: none;

    padding: 15px;

    border-radius: 12px;

    background: var(--brand-accent);

    color: white;

    font-size: 16px;

    font-weight: 700;

    cursor: pointer;

    transition: 0.3s;

    margin-top: 5px;
}

.register-button:hover {
    background: var(--brand-accent-dark);

    transform: translateY(-2px);
}

.login-link {
    text-align: center;

    margin-top: 25px;

    color: #64748b;
}

.login-link a {
    color: var(--brand-accent);

    font-weight: 700;

    text-decoration: none;
}

.login-link a:hover {
    text-decoration: underline;
}

.success-message {
    background: #dcfce7;

    color: #166534;

    border: 1px solid #86efac;

    padding: 12px 15px;

    border-radius: 10px;

    margin-bottom: 20px;
}

.error-message {
    background: #fee2e2;

    color: #991b1b;

    border: 1px solid #fca5a5;

    padding: 12px 15px;

    border-radius: 10px;

    margin-bottom: 20px;
}

.error-message ul {
    margin: 8px 0 0;

    padding-left: 20px;
}

@media (max-width: 600px) {

    .register-page {
        padding: 40px 15px;
    }

    .register-card {
        padding: 28px 20px;
    }

    .register-card h1 {
        font-size: 27px;
    }

}

</style>


<script>

function togglePassword(inputId, iconId) {

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {

        input.type = "text";
        icon.textContent = "🙈";

    } else {

        input.type = "password";
        icon.textContent = "👁";

    }

}

</script>

@endsection