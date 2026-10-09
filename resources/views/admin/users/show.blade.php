@extends('layouts.app')

@section('title', 'Customer Details - Kessy Brothers Food')

@section('content')
@php($latestActivity = $user->loginActivities->first())
<main class="admin-user-detail">
    <div class="admin-user-detail-container">
        <a class="user-detail-back" href="{{ route('admin.users.index', $user->trashed() ? ['archived' => 1] : []) }}">← Back to customers</a>

        @if (session('success'))
            <div class="user-detail-alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="user-detail-alert user-detail-error">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <header class="user-detail-heading">
            <div>
                <span>ADMIN CUSTOMER RECORD</span>
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>
            </div>
            <span class="user-detail-status {{ $user->trashed() ? 'archived' : ($hasActiveSession ? 'active' : 'offline') }}">
                {{ $user->trashed() ? 'Deactivated' : ($hasActiveSession ? 'Active' : 'Logged out / inactive') }}
            </span>
        </header>

        <section class="user-detail-grid">
            <article><span>Gender</span><strong>{{ $user->gender ? ucfirst(str_replace('_', ' ', $user->gender)) : 'Not provided' }}</strong></article>
            <article><span>Phone number</span><strong>{{ $user->phone ?: 'Not provided' }}</strong></article>
            <article><span>Account created</span><strong>{{ $user->created_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i:s') ?? '—' }}</strong></article>
            <article><span>Last login</span><strong>{{ $latestActivity?->logged_in_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i:s') ?? 'Never' }}</strong></article>
            <article><span>Last logout</span><strong>{{ $latestActivity?->logged_out_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i:s') ?? ($latestActivity ? 'Not recorded; session may have expired' : '—') }}</strong></article>
            <article><span>Current / last device</span><strong>{{ $latestActivity?->device ?? 'No login recorded' }}</strong></article>
        </section>

        @if (! $user->trashed())
            <section class="user-detail-actions">
                <a href="{{ route('admin.users.edit', $user->id) }}">Edit customer</a>
                <form method="POST" action="{{ route('admin.users.password-reset', $user->id) }}">
                    @csrf
                    <button type="submit">Send password reset link</button>
                </form>
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Deactivate this account? Order and login history will be retained.');">
                    @csrf
                    @method('DELETE')
                    <button class="danger" type="submit">Deactivate account</button>
                </form>
            </section>
        @else
            <form class="user-detail-restore" method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit">Restore account</button>
            </form>
        @endif

        <section class="user-activity-section">
            <div class="user-activity-heading">
                <div><span>SECURITY HISTORY</span><h2>Login activity</h2></div>
                <small>Most recent 50 sessions</small>
            </div>
            <div class="user-activity-table-wrap">
                <table class="user-activity-table">
                    <thead><tr><th>Event</th><th>Device</th><th>IP address</th><th>Login time</th><th>Last activity</th><th>Logout time</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse ($user->loginActivities as $activity)
                            @php
                                $activityIsActive = ! $activity->logged_out_at && $activity->last_seen_at?->gte($activeCutoff);
                            @endphp
                            <tr>
                                <td>{{ $activity->event_type === 'registration' ? 'Account created' : 'Login' }}</td>
                                <td>{{ $activity->device ?? 'Unknown device' }}</td>
                                <td>{{ $activity->ip_address ?? '—' }}</td>
                                <td>{{ $activity->logged_in_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i:s') ?? '—' }}</td>
                                <td>{{ $activity->last_seen_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i:s') ?? '—' }}</td>
                                <td>{{ $activity->logged_out_at?->timezone('Africa/Dar_es_Salaam')->format('d M Y, H:i:s') ?? '—' }}</td>
                                <td>{{ $activity->logged_out_at ? 'Logged out' : ($activityIsActive ? 'Active' : 'Session expired') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="user-activity-empty">No login activity recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p>When a user closes the browser without logging out, the exact logout time cannot be observed. Such sessions are marked expired after the configured session lifetime, and the last activity time is shown instead.</p>
        </section>
    </div>
</main>

<style>
    .admin-user-detail { min-height: 75vh; padding: 48px 18px 70px; background: #f4f6f9; color: #172235; }
    .admin-user-detail-container { width: min(1180px, 100%); margin: auto; }
    .user-detail-back { color: #147da3; font-weight: 700; text-decoration: none; }
    .user-detail-alert { margin: 20px 0; padding: 14px 16px; border-radius: 10px; background: #dcfce7; color: #166534; }
    .user-detail-error { background: #fee2e2; color: #991b1b; }
    .user-detail-heading { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 24px 0; }
    .user-detail-heading > div > span, .user-activity-heading span { color: #147da3; font-size: 11px; font-weight: 800; letter-spacing: 1.6px; }
    .user-detail-heading h1 { margin: 7px 0; color: #111b2b; font-size: 34px; }
    .user-detail-heading p { margin: 0; color: #64748b; }
    .user-detail-status { padding: 8px 12px; border-radius: 999px; font-size: 12px; font-weight: 800; }
    .user-detail-status.active { background: #dcfce7; color: #166534; }
    .user-detail-status.offline { background: #e8edf3; color: #475569; }
    .user-detail-status.archived { background: #fff1d6; color: #8a4b00; }
    .user-detail-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
    .user-detail-grid article { min-height: 84px; padding: 18px; border: 1px solid #e4e9ef; border-radius: 12px; background: #fff; }
    .user-detail-grid span, .user-detail-grid strong { display: block; }
    .user-detail-grid span { color: #64748b; font-size: 12px; }
    .user-detail-grid strong { margin-top: 9px; color: #111b2b; font-size: 14px; overflow-wrap: anywhere; }
    .user-detail-actions, .user-detail-restore { display: flex; flex-wrap: wrap; gap: 12px; margin: 20px 0 34px; }
    .user-detail-actions a, .user-detail-actions button, .user-detail-restore button { padding: 11px 14px; border: 0; border-radius: 8px; background: #111b2b; color: #fff; font: inherit; font-size: 13px; font-weight: 700; text-decoration: none; cursor: pointer; }
    .user-detail-actions form { margin: 0; }
    .user-detail-actions .danger { background: #b42318; }
    .user-activity-section { margin-top: 34px; padding: 22px; border: 1px solid #e4e9ef; border-radius: 14px; background: #fff; }
    .user-activity-heading { display: flex; justify-content: space-between; align-items: end; gap: 14px; margin-bottom: 18px; }
    .user-activity-heading h2 { margin: 5px 0 0; color: #111b2b; }
    .user-activity-heading small { color: #64748b; }
    .user-activity-table-wrap { overflow-x: auto; }
    .user-activity-table { width: 100%; min-width: 850px; border-collapse: collapse; text-align: left; }
    .user-activity-table th, .user-activity-table td { padding: 12px; border-bottom: 1px solid #edf0f4; font-size: 12px; vertical-align: top; }
    .user-activity-table th { color: #64748b; text-transform: uppercase; font-size: 10px; letter-spacing: .6px; }
    .user-activity-empty { padding: 28px !important; color: #64748b; text-align: center; }
    .user-activity-section > p { margin: 16px 0 0; color: #64748b; font-size: 12px; line-height: 1.6; }
    @media (max-width: 700px) {
        .user-detail-heading { align-items: flex-start; flex-direction: column; }
        .user-detail-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .user-activity-section { padding: 16px; }
    }
    @media (max-width: 420px) { .user-detail-grid { grid-template-columns: 1fr; } }
</style>
@endsection
