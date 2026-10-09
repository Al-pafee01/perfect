@extends('layouts.app')

@section('title', 'Reset Password - Kessy Brothers Food')

@section('content')
<div class="password-reset-page">
    <div class="password-reset-card">
        <a class="password-reset-brand" href="{{ url('/') }}">KESSY BROTHERS <span>FOOD</span></a>
        <h1>Choose a new password</h1>
        <p>Enter and confirm the new password for your account.</p>

        @if ($errors->any())
            <div class="password-reset-errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" autocomplete="email" required>

            <label for="password">New Password</label>
            <input id="password" type="password" name="password" autocomplete="new-password" minlength="8" required>

            <label for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required>

            <button type="submit">Save New Password</button>
        </form>

        <a class="password-reset-login" href="{{ route('login') }}">Back to Login</a>
    </div>
</div>

<style>
    .password-reset-page {
        min-height: 75vh;
        display: grid;
        place-items: center;
        padding: 48px 16px;
        background: linear-gradient(135deg, #111b2b, #22344d);
    }

    .password-reset-card {
        width: min(100%, 460px);
        box-sizing: border-box;
        padding: 38px;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 24px 60px rgba(0, 0, 0, .25);
    }

    .password-reset-brand {
        display: inline-block;
        margin-bottom: 20px;
        color: #111b2b;
        font-size: 16px;
        font-weight: 800;
        letter-spacing: .7px;
        text-decoration: none;
    }

    .password-reset-brand span {
        color: #147da3;
    }

    .password-reset-card h1 {
        margin: 0 0 10px;
        color: #111b2b;
        font-size: 28px;
    }

    .password-reset-card p {
        margin: 0 0 24px;
        color: #64748b;
        line-height: 1.6;
    }

    .password-reset-card label {
        display: block;
        margin: 16px 0 7px;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
    }

    .password-reset-card input {
        width: 100%;
        box-sizing: border-box;
        padding: 13px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        font: inherit;
    }

    .password-reset-card input:focus {
        border-color: #20a9d4;
        outline: 3px solid rgba(32, 169, 212, .15);
    }

    .password-reset-card button {
        width: 100%;
        margin-top: 24px;
        padding: 14px;
        border: 0;
        border-radius: 9px;
        background: linear-gradient(135deg, #f39a1e, #dc8d10);
        color: #111b2b;
        font: inherit;
        font-weight: 800;
        cursor: pointer;
    }

    .password-reset-errors {
        margin-bottom: 18px;
        padding: 12px 14px;
        border: 1px solid #fca5a5;
        border-radius: 9px;
        background: #fee2e2;
        color: #991b1b;
        text-align: left;
    }

    .password-reset-login {
        display: block;
        margin-top: 20px;
        color: #147da3;
        font-size: 14px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
    }

    @media (max-width: 480px) {
        .password-reset-card {
            padding: 28px 22px;
        }
    }
</style>
@endsection
