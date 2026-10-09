@extends('layouts.app')

@section('title', 'Login - Kessy Brothers Food')

@section('content')

<div class="login-page">

    <div class="login-overlay"></div>

    <div class="login-container">

        <div class="login-card">

            {{-- Logo --}}
            <div class="login-logo">
                <img src="{{ asset('images/kessy-tech-pro-logo.png') }}" alt="Kessy Tech Pro logo">
            </div>

            <h1>Welcome Back</h1>

            <p class="login-subtitle">
                Login to your Kessy Brothers Food account
                and enjoy your favorite meals.
            </p>


            {{-- Success Message --}}
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Error Messages --}}
            @if($errors->any())
                <div class="error-message">

                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach

                </div>
            @endif


            {{-- LOGIN FORM --}}
            <form action="{{ route('login.store') }}" method="POST">

                @csrf


                {{-- EMAIL --}}
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
                        autofocus
                    >

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <div class="password-label">

                        <label for="password">
                            Password
                        </label>

                        <a href="{{ url('/forgot-password') }}">
                            Forgot Password?
                        </a>

                    </div>


                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            aria-label="Show or hide password"
                        >
                            <span id="passwordIcon">👁</span>
                        </button>

                    </div>

                </div>


                {{-- REMEMBER ME --}}
                <div class="remember-row">

                    <label class="remember-label">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Remember me
                        </span>

                    </label>

                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    type="submit"
                    class="login-button"
                >
                    Login
                </button>

            </form>


            {{-- CREATE ACCOUNT --}}
            <div class="register-link">

                Don't have an account?

                <a href="{{ route('register') }}">
                    Create Account
                </a>

            </div>


            {{-- HOME --}}
            <div class="home-link">

                <a href="{{ url('/') }}">
                    ← Back to Home
                </a>

            </div>

        </div>

    </div>

</div>


<style>

/* =========================
   LOGIN PAGE
========================= */

.login-page {

    min-height: 85vh;

    position: relative;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 60px 20px;

    background-image:
        url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=1800&q=85');

    background-size: cover;

    background-position: center;

}


/* DARK OVERLAY */

.login-overlay {

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            135deg,
            rgba(2, 6, 23, 0.90),
            rgba(15, 23, 42, 0.78)
        );

}


/* CONTAINER */

.login-container {

    position: relative;

    z-index: 2;

    width: 100%;

    max-width: 460px;

}


/* LOGIN CARD */

.login-card {

    background: rgba(255, 255, 255, 0.97);

    border-radius: 24px;

    padding: 45px 40px;

    box-shadow:
        0 25px 70px rgba(0, 0, 0, 0.35);

    text-align: center;

}


/* LOGO */

.login-logo {

    width: 150px;

    height: 115px;

    margin: 0 auto 20px;

    display: flex;

    align-items: center;

    justify-content: center;

}

.login-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}


/* TITLE */

.login-card h1 {

    margin: 0;

    color: #0f172a;

    font-size: 32px;

    font-weight: 800;

}


.login-subtitle {

    margin: 12px auto 30px;

    color: #64748b;

    font-size: 15px;

    line-height: 1.6;

    max-width: 350px;

}


/* FORM */

.form-group {

    text-align: left;

    margin-bottom: 22px;

}


.form-group label {

    display: block;

    margin-bottom: 8px;

    color: #334155;

    font-size: 14px;

    font-weight: 700;

}


/* PASSWORD LABEL */

.password-label {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

}


.password-label label {

    margin-bottom: 8px;

}


.password-label a {

    color: var(--brand-accent);

    font-size: 13px;

    font-weight: 700;

    text-decoration: none;

}


.password-label a:hover {

    text-decoration: underline;

}


/* INPUT */

.form-group input[type="email"],
.password-wrapper input {

    width: 100%;

    box-sizing: border-box;

    padding: 14px 16px;

    border: 1px solid #cbd5e1;

    border-radius: 12px;

    outline: none;

    background: white;

    color: #0f172a;

    font-size: 15px;

    transition: 0.25s;

}


.form-group input:focus,
.password-wrapper input:focus {

    border-color: var(--brand-accent);

    box-shadow:
        0 0 0 4px rgba(32, 169, 212, 0.10);

}


/* PASSWORD */

.password-wrapper {

    position: relative;

}


.password-wrapper input {

    padding-right: 55px;

}


.password-toggle {

    position: absolute;

    top: 50%;

    right: 7px;

    transform: translateY(-50%);

    width: 40px;

    height: 40px;

    border: none;

    background: transparent;

    cursor: pointer;

    border-radius: 10px;

    font-size: 18px;

}


.password-toggle:hover {

    background: #f1f5f9;

}


/* REMEMBER */

.remember-row {

    display: flex;

    justify-content: flex-start;

    margin: -5px 0 20px;

}


.remember-label {

    display: flex !important;

    align-items: center;

    gap: 8px;

    margin: 0 !important;

    cursor: pointer;

    color: #64748b !important;

    font-size: 14px !important;

    font-weight: 500 !important;

}


.remember-label input {

    width: 16px;

    height: 16px;

    accent-color: var(--brand-accent);

}


/* LOGIN BUTTON */

.login-button {

    width: 100%;

    border: none;

    border-radius: 12px;

    padding: 15px;

    background:
        linear-gradient(
            135deg,
            var(--brand-accent),
            #06b6d4
        );

    color: white;

    font-size: 16px;

    font-weight: 800;

    cursor: pointer;

    transition: 0.25s;

}


.login-button:hover {

    transform: translateY(-2px);

    box-shadow:
        0 12px 25px rgba(32, 169, 212, 0.25);

}


/* SUCCESS */

.success-message {

    margin-bottom: 20px;

    padding: 12px 15px;

    border-radius: 10px;

    background: #dcfce7;

    border: 1px solid #86efac;

    color: #166534;

    font-size: 14px;

    text-align: left;

}


/* ERROR */

.error-message {

    margin-bottom: 20px;

    padding: 12px 15px;

    border-radius: 10px;

    background: #fee2e2;

    border: 1px solid #fca5a5;

    color: #991b1b;

    font-size: 14px;

    text-align: left;

}


/* REGISTER */

.register-link {

    margin-top: 25px;

    color: #64748b;

    font-size: 14px;

}


.register-link a {

    color: var(--brand-accent);

    font-weight: 800;

    text-decoration: none;

}


.register-link a:hover {

    text-decoration: underline;

}


/* HOME */

.home-link {

    margin-top: 18px;

}


.home-link a {

    color: #475569;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

}


.home-link a:hover {

    color: var(--brand-accent);

}


/* MOBILE */

@media (max-width: 600px) {

    .login-page {

        padding: 40px 15px;

    }


    .login-card {

        padding: 35px 22px;

        border-radius: 20px;

    }


    .login-card h1 {

        font-size: 27px;

    }

}

</style>


<script>

function togglePassword() {

    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('passwordIcon');


    if (password.type === 'password') {

        password.type = 'text';

        icon.textContent = '🙈';

    } else {

        password.type = 'password';

        icon.textContent = '👁';

    }

}

</script>

@endsection