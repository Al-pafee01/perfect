@extends('layouts.app')

@section('title', 'Manage Customers - Kessy Brothers Food')

@section('content')
<main class="admin-users-page">
    <div class="admin-users-container">
        <header class="admin-users-header">
            <div class="users-heading-copy">
                <a class="users-back-link" href="{{ route('admin.dashboard') }}">← Dashboard</a>
                <span class="admin-users-eyebrow">CUSTOMER MANAGEMENT</span>
                <h1>{{ $archived ? 'Deactivated customers' : 'Manage customers' }}</h1>
                <p>A clear view of customer accounts, recent activity and access.</p>
            </div>
            <div class="users-header-note">
                <span class="users-header-indicator" aria-hidden="true"></span>
                <span>{{ $archived ? 'Archived accounts' : 'Customer records' }}</span>
            </div>
        </header>

        @if (session('success'))
            <div class="users-alert users-alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="users-alert users-alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @unless ($archived)
            <section class="users-stats" aria-label="Customer statistics">
                <article class="users-stat-card">
                    <span class="users-stat-icon customers-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    <span class="users-stat-label">All customers</span>
                    <strong>{{ number_format($totalCustomers) }}</strong>
                    <small>Registered accounts</small>
                </article>
                <article class="users-stat-card">
                    <span class="users-stat-icon active-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M20 11.08V12a8 8 0 1 1-4.75-7.31"/><path d="m20 4-8 8-3-3"/></svg>
                    </span>
                    <span class="users-stat-label">Active recently</span>
                    <strong>{{ number_format($activeCustomers) }}</strong>
                    <small>Within session lifetime</small>
                </article>
                <article class="users-stat-card">
                    <span class="users-stat-icon joined-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/></svg>
                    </span>
                    <span class="users-stat-label">Joined today</span>
                    <strong>{{ number_format($registeredToday) }}</strong>
                    <small>New customer accounts</small>
                </article>
            </section>
        @endunless

        <nav class="users-tabs" aria-label="Customer account views">
            <a class="{{ ! $archived ? 'selected' : '' }}" href="{{ route('admin.users.index') }}" @if (! $archived) aria-current="page" @endif>Active accounts</a>
            <a class="{{ $archived ? 'selected' : '' }}" href="{{ route('admin.users.index', ['archived' => 1]) }}" @if ($archived) aria-current="page" @endif>Deactivated accounts</a>
        </nav>

        <form class="users-filters" method="GET" action="{{ route('admin.users.index') }}">
            @if ($archived)
                <input type="hidden" name="archived" value="1">
            @endif
            <label class="users-search-field">
                <svg aria-hidden="true" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name, email or phone" aria-label="Search customers">
            </label>
            @unless ($archived)
                <select name="status" aria-label="Filter by login status">
                    <option value="">All login statuses</option>
                    <option value="active" @selected(request('status') === 'active')>Active recently</option>
                    <option value="logged_out" @selected(request('status') === 'logged_out')>Logged out / inactive</option>
                </select>
            @endunless
            <button type="submit">Apply filters</button>
            @if (request()->filled('search') || request()->filled('status'))
                <a class="users-clear-link" href="{{ route('admin.users.index', $archived ? ['archived' => 1] : []) }}">Clear filters</a>
            @endif
        </form>

        <div class="users-table-wrap">
            <div class="users-table-heading">
                <div>
                    <h2>{{ $archived ? 'Deactivated accounts' : 'Customer directory' }}</h2>
                    <p>{{ $users->total() }} {{ \Illuminate\Support\Str::plural('record', $users->total()) }}{{ request()->filled('search') ? ' matching your search' : '' }}</p>
                </div>
                <span class="users-page-size">20 per page</span>
            </div>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Profile</th>
                        <th>Registered</th>
                        <th>Registration device / IP</th>
                        <th>Last login</th>
                        <th>Session status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        @php
                            $latestActivity = $user->latestLoginActivity;
                            $registrationActivity = $user->firstLoginActivity;
                            $isActive = $user->active_login_activities_count > 0;
                        @endphp
                        <tr>
                            <td>
                                <div class="users-customer-cell">
                                    <span class="users-avatar" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->name, 0, 1)) }}</span>
                                    <span class="users-customer-copy">
                                        <strong>{{ $user->name }}</strong>
                                        <a class="users-email" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span>{{ $user->gender ? ucfirst(str_replace('_', ' ', $user->gender)) : 'Not provided' }}</span>
                                <small>{{ $user->phone ?: 'No phone' }}</small>
                            </td>
                            <td>{{ $user->created_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i') ?? '—' }}</td>
                            <td>
                                <span>{{ $registrationActivity?->device ?? 'Not recorded' }}</span>
                                <small>{{ $registrationActivity?->ip_address ?? 'No registration IP recorded' }}</small>
                            </td>
                            <td>{{ $latestActivity?->logged_in_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i') ?? 'Never' }}</td>
                            <td>
                                @if ($archived)
                                    <span class="users-status status-archived">Deactivated</span>
                                @elseif ($isActive)
                                    <span class="users-status status-active">Active now</span>
                                    <small>Seen {{ $latestActivity?->last_seen_at?->diffForHumans() ?? 'recently' }}</small>
                                @elseif ($latestActivity?->logged_out_at)
                                    <span class="users-status status-offline">Logged out</span>
                                    <small>{{ $latestActivity->logged_out_at->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i') }}</small>
                                @elseif ($latestActivity)
                                    <span class="users-status status-offline">Inactive</span>
                                    <small>Last seen {{ $latestActivity->last_seen_at->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i') }}</small>
                                @else
                                    <span class="users-status status-offline">Never logged in</span>
                                @endif
                            </td>
                            <td>
                                <div class="users-actions">
                                    <a href="{{ route('admin.users.show', $user->id) }}">View</a>
                                    @if ($archived)
                                        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="restore-action">Restore</button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                                        <form method="POST" action="{{ route('admin.users.password-reset', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="reset-action">Send reset link</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Deactivate this customer account? Their order and login history will be retained.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="deactivate-action">Deactivate</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="users-empty">No customer accounts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="users-pagination">{{ $users->links() }}</div>
        <p class="users-privacy-note">Login status uses activity recorded during the configured session lifetime. A closed browser may appear active until the session expires. Device and IP details are retained for account security.</p>
    </div>
</main>

<style>
    .admin-users-page { min-height: 75vh; padding: 42px 24px 72px; background: #f5f6f8; color: #172235; }
    .admin-users-container { width: min(1500px, 100%); margin: 0 auto; }
    .admin-users-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 24px; margin-bottom: 28px; }
    .users-heading-copy { display: grid; justify-items: start; }
    .admin-users-eyebrow { margin-top: 22px; color: #147da3; font-size: 11px; font-weight: 800; letter-spacing: 1.5px; }
    .admin-users-header h1 { margin: 6px 0 8px; color: #111b2b; font-size: clamp(29px, 4vw, 38px); letter-spacing: -.8px; }
    .admin-users-header p { margin: 0; color: #687588; font-size: 14px; }
    .users-back-link { color: #536174; font-size: 13px; font-weight: 650; text-decoration: none; }
    .users-back-link:hover, .users-clear-link:hover { color: #147da3; }
    .users-header-note { display: inline-flex; align-items: center; gap: 9px; padding: 10px 13px; border: 1px solid #e1e5eb; border-radius: 8px; background: #fff; color: #536174; font-size: 12px; font-weight: 650; }
    .users-header-indicator { width: 8px; height: 8px; border-radius: 50%; background: #20a36a; }
    .users-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin: 26px 0 30px; }
    .users-stat-card { display: grid; grid-template-columns: 42px 1fr; grid-template-rows: auto auto auto; align-items: center; column-gap: 14px; padding: 20px; border: 1px solid #e4e8ee; border-radius: 10px; background: #fff; }
    .users-stat-icon { display: grid; grid-row: 1 / 4; place-items: center; width: 42px; height: 42px; border-radius: 9px; }
    .users-stat-icon svg, .users-search-field svg { width: 19px; height: 19px; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.7; }
    .customers-icon { background: #e9f2fa; color: #28628b; }
    .active-icon { background: #e9f5ef; color: #31815e; }
    .joined-icon { background: #fff3e5; color: #a66b1d; }
    .users-stat-label { color: #687588; font-size: 12px; font-weight: 600; }
    .users-stat-card strong { margin-top: 3px; color: #172235; font-size: 27px; font-weight: 700; line-height: 1.2; }
    .users-stat-card small { margin-top: 4px; color: #8a95a4; font-size: 11px; }
    .users-tabs { display: flex; gap: 24px; margin: 0; border-bottom: 1px solid #e0e5eb; }
    .users-tabs a { position: relative; padding: 13px 2px; color: #707c8c; font-size: 13px; font-weight: 650; text-decoration: none; }
    .users-tabs a.selected { color: #172235; }
    .users-tabs a.selected::after { position: absolute; right: 0; bottom: -1px; left: 0; height: 2px; background: #e89a2e; content: ""; }
    .users-alert { margin: 18px 0; padding: 14px 16px; border: 1px solid transparent; border-radius: 8px; font-size: 13px; }
    .users-alert-success { border-color: #cfe8da; background: #f0f8f3; color: #286b48; }
    .users-alert-error { border-color: #f2d2d0; background: #fff5f4; color: #a23b34; }
    .users-filters { display: flex; align-items: center; gap: 10px; margin: 18px 0 16px; }
    .users-search-field { display: flex; flex: 1 1 340px; align-items: center; gap: 9px; min-width: 220px; min-height: 42px; padding: 0 12px; border: 1px solid #dfe4eb; border-radius: 7px; background: #fff; color: #8994a2; }
    .users-search-field:focus-within { border-color: #73aec2; box-shadow: 0 0 0 3px rgb(32 169 212 / 10%); }
    .users-search-field input { width: 100%; min-width: 0; border: 0; outline: 0; background: transparent; color: #172235; font: inherit; font-size: 13px; }
    .users-search-field input::placeholder { color: #9aa4b1; }
    .users-filters select { min-height: 42px; padding: 0 34px 0 12px; border: 1px solid #dfe4eb; border-radius: 7px; background: #fff; color: #465365; font: inherit; font-size: 13px; }
    .users-filters button { min-height: 42px; padding: 0 17px; border: 1px solid #172235; border-radius: 7px; background: #172235; color: #fff; font: inherit; font-size: 13px; font-weight: 650; cursor: pointer; transition: background .15s ease; }
    .users-filters button:hover { background: #26374d; }
    .users-clear-link { padding: 8px 3px; color: #687588; font-size: 12px; font-weight: 650; text-decoration: none; }
    .users-table-wrap { overflow: hidden; border: 1px solid #e2e6ec; border-radius: 10px; background: #fff; }
    .users-table-heading { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 18px 20px; border-bottom: 1px solid #edf0f3; }
    .users-table-heading h2 { margin: 0; color: #172235; font-size: 15px; font-weight: 700; }
    .users-table-heading p { margin: 4px 0 0; color: #818c9b; font-size: 12px; }
    .users-page-size { color: #818c9b; font-size: 11px; }
    .users-table { width: 100%; min-width: 1080px; border-collapse: collapse; text-align: left; }
    .users-table th, .users-table td { padding: 14px 13px; border-bottom: 1px solid #edf0f3; vertical-align: middle; }
    .users-table th:first-child, .users-table td:first-child { padding-left: 20px; }
    .users-table th:last-child, .users-table td:last-child { padding-right: 20px; }
    .users-table th { background: #fafbfc; color: #788394; font-size: 10px; font-weight: 750; letter-spacing: .7px; text-transform: uppercase; white-space: nowrap; }
    .users-table td { color: #465365; font-size: 12px; line-height: 1.5; }
    .users-table tbody tr:last-child td { border-bottom: 0; }
    .users-table tbody tr:hover { background: #fcfcfd; }
    .users-customer-cell { display: flex; align-items: center; gap: 10px; min-width: 190px; }
    .users-avatar { display: grid; flex: 0 0 34px; place-items: center; width: 34px; height: 34px; border: 1px solid #e2e7ed; border-radius: 50%; background: #f1f4f7; color: #40536a; font-size: 12px; font-weight: 750; }
    .users-customer-copy { min-width: 0; }
    .users-customer-copy strong { display: block; overflow: hidden; color: #172235; font-size: 12px; font-weight: 700; text-overflow: ellipsis; white-space: nowrap; }
    .users-table td small, .users-email { display: block; margin-top: 3px; color: #818c9b; font-size: 11px; }
    .users-email { overflow: hidden; text-decoration: none; text-overflow: ellipsis; white-space: nowrap; }
    .users-email:hover { color: #147da3; }
    .users-status { display: inline-flex; align-items: center; gap: 6px; width: fit-content; padding: 5px 8px; border-radius: 5px; font-size: 10px; font-weight: 700; white-space: nowrap; }
    .users-status::before { width: 6px; height: 6px; border-radius: 50%; background: currentColor; content: ""; }
    .status-active { background: #edf7f0; color: #347451; }
    .status-offline { background: #f0f2f5; color: #687588; }
    .status-archived { background: #fff5e7; color: #92601d; }
    .users-actions { display: flex; flex-wrap: wrap; gap: 6px; min-width: 215px; }
    .users-actions a, .users-actions button { padding: 6px 8px; border: 1px solid #e5e9ee; border-radius: 5px; background: #fff; color: #465365; font: inherit; font-size: 10px; font-weight: 650; text-decoration: none; white-space: nowrap; cursor: pointer; }
    .users-actions a:hover { border-color: #b9d6df; color: #147da3; }
    .users-actions .reset-action { color: #8a5a00; }
    .users-actions .deactivate-action { border-color: #f0ddda; color: #a3443d; }
    .users-actions .restore-action { color: #347451; }
    .users-actions form { margin: 0; }
    .users-empty { padding: 42px 20px !important; color: #687588 !important; text-align: center; }
    .users-pagination { margin-top: 18px; }
    .users-privacy-note { max-width: 900px; margin-top: 18px; color: #858f9e; font-size: 11px; line-height: 1.6; }
    @media (max-width: 760px) {
        .admin-users-page { padding: 30px 15px 56px; }
        .admin-users-header { align-items: flex-start; flex-direction: column; gap: 16px; }
        .users-header-note { align-self: flex-start; }
        .users-stats { grid-template-columns: 1fr; gap: 10px; margin: 20px 0 24px; }
        .users-stat-card { padding: 15px 17px; }
        .users-filters { flex-wrap: wrap; }
        .users-search-field { flex-basis: 100%; }
        .users-filters select { flex: 1 1 180px; }
        .users-filters button { flex: 1 1 130px; }
        .users-table-wrap { overflow-x: auto; }
        .users-table-heading { padding: 16px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .users-filters button { transition: none; }
    }
</style>
@endsection
