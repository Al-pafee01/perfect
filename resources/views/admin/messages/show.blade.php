@extends('layouts.app')

@section('title', 'View Message - Admin')

@section('content')

<div class="message-show-page">

    <div class="message-container">

        {{-- HEADER --}}
        <div class="page-header">

            <div>
                <span>ADMIN PANEL</span>
                <h1>📨 Message Details</h1>
                <p>View the full message sent by your customer.</p>
            </div>

            <a href="{{ route('admin.messages.index') }}" class="back-btn">
                ← All Messages
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif


        {{-- MESSAGE CARD --}}
        <div class="message-card">

            <div class="message-top">

                <div class="customer-avatar">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>

                <div>
                    <h2>{{ $message->name }}</h2>
                    <p>{{ $message->email }}</p>
                </div>

            </div>


            {{-- CUSTOMER INFORMATION --}}
            <div class="info-grid">

                <div class="info-box">
                    <span>Customer Name</span>
                    <strong>{{ $message->name }}</strong>
                </div>

                <div class="info-box">
                    <span>Email</span>
                    <strong>{{ $message->email }}</strong>
                </div>

                <div class="info-box">
                    <span>Phone</span>
                    <strong>
                        {{ $message->phone ?? 'Not provided' }}
                    </strong>
                </div>

                <div class="info-box">
                    <span>Date Sent</span>
                    <strong>
                        {{ $message->created_at->format('d M Y, H:i') }}
                    </strong>
                </div>

            </div>


            {{-- SUBJECT --}}
            <div class="subject-section">

                <span>SUBJECT</span>

                <h3>
                    {{ $message->subject ?? 'No subject' }}
                </h3>

            </div>


            {{-- MESSAGE --}}
            <div class="message-section">

                <span>MESSAGE</span>

                <div class="message-content">
                    {{ $message->message }}
                </div>

            </div>


            {{-- STATUS --}}
            <div class="status-section">

                <div>

                    <span>MESSAGE STATUS</span>

                    @if($message->is_read)

                        <div class="status read">
                            ✓ Read
                        </div>

                    @else

                        <div class="status unread">
                            ● New / Unread
                        </div>

                    @endif

                </div>


                {{-- MARK AS READ --}}
                @if(!$message->is_read)

                    <form
                        action="{{ route('admin.messages.read', $message) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="read-btn">
                            ✓ Mark as Read
                        </button>

                    </form>

                @endif

            </div>


            {{-- ACTIONS --}}
            <div class="message-actions">

                <a
                    href="mailto:{{ $message->email }}"
                    class="email-btn"
                >
                    ✉ Reply by Email
                </a>


                @if($message->phone)

                    <a
                        href="tel:{{ $message->phone }}"
                        class="call-btn"
                    >
                        📞 Call Customer
                    </a>

                @endif


                <form
                    action="{{ route('admin.messages.destroy', $message) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this message?');"
                >

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-btn">
                        🗑 Delete Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


<style>

.message-show-page {
    min-height: 80vh;
    padding: 60px 20px;
    background: #f8fafc;
}

.message-container {
    max-width: 1000px;
    margin: auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.page-header span {
    color: var(--brand-accent);
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 2px;
}

.page-header h1 {
    margin: 8px 0;
    color: #0f172a;
    font-size: 38px;
}

.page-header p {
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

.message-card {
    background: white;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
}

.message-top {
    display: flex;
    align-items: center;
    gap: 18px;
    padding-bottom: 30px;
    border-bottom: 1px solid #e2e8f0;
}

.customer-avatar {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    background: var(--brand-accent);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    font-weight: 800;
}

.message-top h2 {
    margin: 0 0 5px;
    color: #0f172a;
}

.message-top p {
    margin: 0;
    color: #64748b;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-top: 30px;
}

.info-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px;
}

.info-box span,
.subject-section > span,
.message-section > span,
.status-section span {
    display: block;
    color: #64748b;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 7px;
}

.info-box strong {
    color: #0f172a;
    word-break: break-word;
}

.subject-section {
    margin-top: 30px;
}

.subject-section h3 {
    color: #0f172a;
    font-size: 22px;
    margin: 0;
}

.message-section {
    margin-top: 30px;
}

.message-content {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px;
    color: #334155;
    line-height: 1.8;
    white-space: pre-wrap;
    word-break: break-word;
}

.status-section {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.status {
    display: inline-block;
    padding: 7px 12px;
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
    color: var(--brand-accent-dark);
}

.read-btn {
    border: none;
    background: #16a34a;
    color: white;
    padding: 11px 18px;
    border-radius: 9px;
    font-weight: 700;
    cursor: pointer;
}

.read-btn:hover {
    background: #15803d;
}

.message-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e2e8f0;
}

.message-actions a,
.message-actions button {
    text-decoration: none;
    border: none;
    padding: 12px 18px;
    border-radius: 9px;
    font-weight: 700;
    cursor: pointer;
    font-size: 14px;
}

.email-btn {
    background: var(--brand-accent);
    color: white;
}

.call-btn {
    background: #0f172a;
    color: white;
}

.delete-btn {
    background: #fee2e2;
    color: #b91c1c;
}

@media (max-width: 700px) {

    .message-show-page {
        padding: 40px 15px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-header h1 {
        font-size: 30px;
    }

    .back-btn {
        width: 100%;
        text-align: center;
    }

    .message-card {
        padding: 22px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .status-section {
        flex-direction: column;
        align-items: flex-start;
    }

    .message-actions {
        flex-direction: column;
    }

    .message-actions a,
    .message-actions button {
        width: 100%;
        text-align: center;
    }

}

</style>

@endsection