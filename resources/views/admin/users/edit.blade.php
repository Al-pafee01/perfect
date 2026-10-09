@extends('layouts.app')

@section('title', 'Edit Customer - Kessy Brothers Food')

@section('content')
<main class="admin-user-edit-page">
    <section class="admin-user-edit-card">
        <a href="{{ route('admin.users.show', $user->id) }}">← Back to customer</a>
        <span class="admin-user-edit-label">ADMIN PANEL</span>
        <h1>Edit customer</h1>
        <p>Updating the email will not require a second verification, as requested.</p>

        @if ($errors->any())
            <div class="admin-user-edit-errors">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PATCH')

            <label for="name">Full name</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" maxlength="255" required>

            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" maxlength="255" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="" disabled @selected(old('gender', $user->gender) === null)>Select gender</option>
                <option value="female" @selected(old('gender', $user->gender) === 'female')>Female</option>
                <option value="male" @selected(old('gender', $user->gender) === 'male')>Male</option>
                <option value="prefer_not_to_say" @selected(old('gender', $user->gender) === 'prefer_not_to_say')>Prefer not to say</option>
            </select>

            <label for="phone">Phone number</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="32" required>

            <button type="submit">Save customer details</button>
        </form>
    </section>
</main>

<style>
    .admin-user-edit-page { min-height: 75vh; display: grid; place-items: center; padding: 42px 16px; background: #f4f6f9; }
    .admin-user-edit-card { width: min(100%, 540px); box-sizing: border-box; padding: 32px; border: 1px solid #e4e9ef; border-radius: 16px; background: #fff; box-shadow: 0 16px 40px rgba(17, 27, 43, .08); }
    .admin-user-edit-card > a { color: #147da3; font-size: 13px; font-weight: 700; text-decoration: none; }
    .admin-user-edit-label { display: block; margin-top: 24px; color: #147da3; font-size: 11px; font-weight: 800; letter-spacing: 1.5px; }
    .admin-user-edit-card h1 { margin: 7px 0; color: #111b2b; }
    .admin-user-edit-card p { margin: 0 0 22px; color: #64748b; font-size: 13px; line-height: 1.5; }
    .admin-user-edit-card label { display: block; margin: 15px 0 6px; color: #334155; font-size: 13px; font-weight: 700; }
    .admin-user-edit-card input, .admin-user-edit-card select { width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; background: #fff; font: inherit; }
    .admin-user-edit-card button { width: 100%; margin-top: 24px; padding: 13px; border: 0; border-radius: 8px; background: #111b2b; color: #fff; font: inherit; font-weight: 800; cursor: pointer; }
    .admin-user-edit-errors { padding: 12px; border-radius: 8px; background: #fee2e2; color: #991b1b; font-size: 13px; }
    @media (max-width: 520px) { .admin-user-edit-card { padding: 24px 20px; } }
</style>
@endsection
