@extends('layouts.app')

@section('title', 'Contact Messages - Admin')

@section('content')

<div class="messages-page">

    <div class="messages-container">

        {{-- HEADER --}}
        <div class="messages-header">
            <div>
                <span class="header-label">ADMIN PANEL</span>
                <h1>📨 Contact Messages</h1>
                <p>View and manage messages sent by customers.</p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                ← Dashboard
            </a>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- MESSAGES --}}
        @if($messages->count())

            <div class="messages-card">

                <div class="table-wrapper">

                    <table>

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($messages as $message)

                                <tr class="{{ !$message->is_read ? 'unread-row' : '' }}">

                                    <td>
                                        #{{ $message->id }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $message->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $message->email }}
                                    </td>

                                    <td>
                                        {{ $message->subject ?? 'No subject' }}
                                    </td>

                                    <td>

                                        @if($message->is_read)

                                            <span class="status read">
                                                ✓ Read
                                            </span>

                                        @else

                                            <span class="status unread">
                                                ● New
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $message->created_at->format('d M Y, H:i') }}
                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('admin.messages.show', $message) }}"
                                            class="view-btn"
                                        >
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

            <div class="empty-messages">

                <div class="empty-icon">
                    📨
                </div>

                <h2>No Messages Yet</h2>

                <p>
                    Customer messages will appear here when someone
                    contacts Kessy Brothers Food.
                </p>

                <a href="{{ route('contact') }}" class="contact-btn">
                    View Contact Page
                </a>

            </div>

        @endif

    </div>

</div>


<style>

.messages-page {
    min-height: 80vh;
    padding: 60px 20px;
    background: #f8fafc;
}

.messages-container {
    max-width: 1200px;
    margin: auto;
}

.messages-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.header-label {
    color: #2563eb;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 2px;
}

.messages-header h1 {
    margin: 8px 0;
    font-size: 38px;
    color: #0f172a;
}

.messages-header p {
    margin: 0;
    color: #64748b;
}

.back-btn {
    background: #0f172a;
    color: white;
    text-decoration: none;
    padding: 13px 20px;
    border-radius: 10px;
    font-weight: 700;
}

.success-message {
    background: #dcfce7;
    color: #166534;
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    font-weight: 700;
}

.messages-card {
    background: white;
    border-radius: 18px;
    box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
    overflow: hidden;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 850px;
}

thead {
    background: #0f172a;
    color: white;
}

th {
    padding: 17px 15px;
    text-align: left;
    font-size: 13px;
    letter-spacing: .3px;
}

td {
    padding: 17px 15px;
    border-bottom: 1px solid #e2e8f0;
    color: #475569;
    font-size: 14px;
}

tbody tr:hover {
    background: #f8fafc;
}

.unread-row {
    background: #eff6ff;
}

.status {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 800;
}

.status.read {
    background: #dcfce7;
    color: #166534;
}

.status.unread {
    background: #dbeafe;
    color: #1d4ed8;
}

.view-btn {
    display: inline-block;
    background: #2563eb;
    color: white;
    text-decoration: none;
    padding: 9px 15px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13px;
}

.view-btn:hover {
    background: #1d4ed8;
}

.empty-messages {
    background: white;
    text-align: center;
    padding: 70px 25px;
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
}

.empty-icon {
    font-size: 60px;
    margin-bottom: 15px;
}

.empty-messages h2 {
    color: #0f172a;
    margin-bottom: 10px;
}

.empty-messages p {
    color: #64748b;
    max-width: 500px;
    margin: 0 auto 25px;
}

.contact-btn {
    display: inline-block;
    background: #2563eb;
    color: white;
    text-decoration: none;
    padding: 13px 20px;
    border-radius: 10px;
    font-weight: 700;
}

@media (max-width: 700px) {

    .messages-page {
        padding: 40px 15px;
    }

    .messages-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .messages-header h1 {
        font-size: 30px;
    }

    .back-btn {
        width: 100%;
        text-align: center;
    }

}

</style>

@endsection