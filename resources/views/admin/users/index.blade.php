@extends('layouts.app')

@section('title', 'Manage Customers - Kessy Brothers Food')

@section('content')
<main class="admin-users-page">
    <div class="admin-users-container">
        <header class="admin-users-header">
            <div>
                <span class="admin-users-eyebrow">ADMIN PANEL</span>
                <h1>{{ $archived ? 'Deactivated Customers' : 'Customer Accounts' }}</h1>
                <p>Review customer profiles, login activity, and account access.</p>
            </div>
            <a class="users-back-link" href="{{ route('admin.dashboard') }}">Back to dashboard</a>
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
                <article><span>Customer accounts</span><strong>{{ number_format($totalCustomers) }}</strong></article>
                <article><span>Active recently</span><strong>{{ number_format($activeCustomers) }}</strong></article>
                <article><span>Joined today</span><strong>{{ number_format($registeredToday) }}</strong></article>
            </section>
        @endunless

        <nav class="users-tabs" aria-label="Customer account views">
            <a class="{{ ! $archived ? 'selected' : '' }}" href="{{ route('admin.users.index') }}">Active accounts</a>
            <a class="{{ $archived ? 'selected' : '' }}" href="{{ route('admin.users.index', ['archived' => 1]) }}">Deactivated accounts</a>
        </nav>

        <form class="users-filters" method="GET" action="{{ route('admin.users.index') }}">
            @if ($archived)
                <input type="hidden" name="archived" value="1">
            @endif
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search name, email, or phone" aria-label="Search customers">
            @unless ($archived)
                <select name="status" aria-label="Filter by login status">
                    <option value="">All login statuses</option>
                    <option value="active" @selected(request('status') === 'active')>Active recently</option>
                    <option value="logged_out" @selected(request('status') === 'logged_out')>Logged out / inactive</option>
                </select>
            @endunless
            <button type="submit">Search</button>
            <a href="{{ route('admin.users.index', $archived ? ['archived' => 1] : []) }}">Clear</a>
        </form>

        <div class="users-table-wrap">
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
                                <strong>{{ $user->name }}</strong>
                                <a class="users-email" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
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
                                    <span class="users-status status-active">Active</span>
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
        <p class="users-privacy-note">Login status is based on recent activity during the configured session lifetime. A closed browser may appear active until that session expires. Device and IP details are collected for account security and administration.</p>
    </div>
</main>

<style>
    .admin-users-page { min-height: 75vh; padding: 48px 18px 72px; background: #f4f6f9; color: #172235; }
    .admin-users-container { width: min(1440px, 100%); margin: 0 auto; }
    .admin-users-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 28px; }
    .admin-users-eyebrow { color: #147da3; font-size: 12px; font-weight: 800; letter-spacing: 1.8px; }
    .admin-users-header h1 { margin: 8px 0; color: #111b2b; font-size: clamp(27px, 4vw, 38px); }
    .admin-users-header p { margin: 0; color: #64748b; }
    .users-back-link, .users-filters a { color: #147da3; font-weight: 700; text-decoration: none; }
    .users-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin: 24px 0; }
    .users-stats article { padding: 20px; border: 1px solid #e4e9ef; border-radius: 14px; background: #fff; }
    .users-stats span, .users-stats strong { display: block; }
    .users-stats span { color: #64748b; font-size: 13px; }
    .users-stats strong { margin-top: 8px; color: #111b2b; font-size: 28px; }
    .users-tabs { display: flex; gap: 8px; margin: 26px 0 14px; border-bottom: 1px solid #dce3eb; }
    .users-tabs a { padding: 12px 16px; color: #64748b; font-weight: 700; text-decoration: none; }
    .users-tabs a.selected { border-bottom: 3px solid #f39a1e; color: #111b2b; }
    .users-alert { margin: 18px 0; padding: 14px 16px; border-radius: 10px; }
    .users-alert-success { background: #dcfce7; color: #166534; }
    .users-alert-error { background: #fee2e2; color: #991b1b; }
    .users-filters { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin: 18px 0; }
    .users-filters input, .users-filters select { min-height: 43px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; background: #fff; font: inherit; }
    .users-filters input { flex: 1 1 260px; }
    .users-filters button { min-height: 43px; padding: 0 18px; border: 0; border-radius: 8px; background: #111b2b; color: #fff; font-weight: 700; cursor: pointer; }
    .users-table-wrap { overflow-x: auto; border: 1px solid #e4e9ef; border-radius: 14px; background: #fff; }
    .users-table { width: 100%; min-width: 1120px; border-collapse: collapse; text-align: left; }
    .users-table th, .users-table td { padding: 15px 13px; border-bottom: 1px solid #edf0f4; vertical-align: top; }
    .users-table th { background: #f8fafc; color: #64748b; font-size: 11px; letter-spacing: .7px; text-transform: uppercase; }
    .users-table td { color: #273244; font-size: 13px; }
    .users-table td strong, .users-table td small, .users-table td > span { display: block; }
    .users-table td strong { color: #111b2b; font-size: 14px; }
    .users-table td small, .users-email { margin-top: 5px; color: #64748b; font-size: 12px; }
    .users-email { display: block; text-decoration: none; }
    .users-status { width: fit-content; padding: 5px 9px; border-radius: 999px; font-size: 11px; font-weight: 800; }
    .status-active { background: #dcfce7; color: #166534; }
    .status-offline { background: #eef2f7; color: #475569; }
    .status-archived { background: #fff1d6; color: #8a4b00; }
    .users-actions { display: flex; flex-wrap: wrap; gap: 9px; min-width: 210px; }
    .users-actions a, .users-actions button { padding: 0; border: 0; background: none; color: #147da3; font: inherit; font-size: 12px; font-weight: 800; text-decoration: none; cursor: pointer; }
    .users-actions .reset-action { color: #8a5a00; }
    .users-actions .deactivate-action { color: #b42318; }
    .users-actions .restore-action { color: #166534; }
    .users-actions form { margin: 0; }
    .users-empty { padding: 40px !important; color: #64748b !important; text-align: center; }
    .users-pagination { margin-top: 22px; }
    .users-privacy-note { margin-top: 18px; color: #64748b; font-size: 12px; line-height: 1.6; }
    @media (max-width: 640px) {
        .admin-users-header { align-items: flex-start; flex-direction: column; }
        .users-stats { grid-template-columns: 1fr; gap: 10px; }
    }
</style>
@endsection
