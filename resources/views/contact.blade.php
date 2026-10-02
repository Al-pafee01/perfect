@extends('layouts.app')

@section('title', 'Contact Us - Kessy Brothers Food')

@section('content')

<div class="contact-page">

    <!-- =========================
         HERO
    ========================== -->

    <section class="contact-hero">

        <div class="contact-hero-overlay"></div>

        <div class="contact-hero-content">

            <span class="hero-badge">
                🍽️ KESSY BROTHERS FOOD
            </span>

            <h1>
                Let's Prepare Your Next Great Meal.
            </h1>

            <p>
                Have a question about our menu, an order, or delivery?
                We would love to hear from you.
            </p>

        </div>

    </section>


    <!-- =========================
         CONTACT CONTENT
    ========================== -->

    <section class="contact-section">

        <div class="contact-container">


            <!-- =========================
                 LEFT SIDE
            ========================== -->

            <div class="contact-info">

                <div class="section-heading">

                    <span>
                        GET IN TOUCH
                    </span>

                    <h2>
                        We'd Love To Hear From You
                    </h2>

                    <p>
                        Whether you want to ask about a meal,
                        place an order, or simply say hello,
                        our team is ready to help.
                    </p>

                </div>


                <!-- PHONE -->

                <a
                    href="tel:+255634887763"
                    class="contact-card"
                >

                    <div class="contact-icon">
                        📞
                    </div>

                    <div class="contact-card-content">

                        <span>
                            Call Us
                        </span>

                        <strong>
                            0634 887 763
                        </strong>

                        <small>
                            Tap to call us
                        </small>

                    </div>

                    <div class="contact-arrow">
                        →
                    </div>

                </a>


                <!-- WHATSAPP -->

                <a
                    href="https://wa.me/255795651827?text=Hello%20Kessy%20Delicious%2C%20I%20would%20like%20to%20make%20an%20inquiry."
                    target="_blank"
                    rel="noopener noreferrer"
                    class="contact-card whatsapp-card"
                >

                    <div class="contact-icon whatsapp-icon">
                        💬
                    </div>

                    <div class="contact-card-content">

                        <span>
                            WhatsApp
                        </span>

                        <strong>
                            0795 651 827
                        </strong>

                        <small>
                            Chat with us on WhatsApp
                        </small>

                    </div>

                    <div class="contact-arrow">
                        →
                    </div>

                </a>


                <!-- EMAIL -->

                <a
                    href="mailto:perfectkessy2005@gmail.com?subject=Kessy%20Delicious%20Inquiry"
                    class="contact-card"
                >

                    <div class="contact-icon">
                        ✉️
                    </div>

                    <div class="contact-card-content">

                        <span>
                            Email Us
                        </span>

                        <strong>
                            perfectkessy2005@gmail.com
                        </strong>

                        <small>
                            Send us an email
                        </small>

                    </div>

                    <div class="contact-arrow">
                        →
                    </div>

                </a>


                <!-- LOCATION -->

                <div class="contact-card location-card">

                    <div class="contact-icon">
                        📍
                    </div>

                    <div class="contact-card-content">

                        <span>
                            Find Us
                        </span>

                        <strong>
                            Shant Town, Moshi
                        </strong>

                        <small>
                            Moshi, Kilimanjaro, Tanzania
                        </small>

                    </div>

                </div>


                <!-- WHATSAPP CTA -->

                <a
                    href="https://wa.me/255795651827?text=Hello%20Kessy%20Delicious%2C%20I%20need%20help."
                    target="_blank"
                    rel="noopener noreferrer"
                    class="whatsapp-button"
                >

                    <span class="whatsapp-button-icon">
                        💬
                    </span>

                    <span>
                        Chat With Us on WhatsApp
                    </span>

                    <span>
                        →
                    </span>

                </a>

            </div>



            <!-- =========================
                 RIGHT SIDE FORM
            ========================== -->

            <div class="contact-form-wrapper">

                <div class="form-header">

                    <span>
                        SEND A MESSAGE
                    </span>

                    <h2>
                        How Can We Help?
                    </h2>

                    <p>
                        Fill in the form below and send us your message.
                        Your message will be received and saved securely.
                    </p>

                </div>


                <!-- SUCCESS MESSAGE -->

                @if(session('success'))

                    <div class="success-message">

                        <div class="success-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Message Sent Successfully
                            </strong>

                            <p>
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                @endif


                <!-- ERROR SUMMARY -->

                @if($errors->any())

                    <div class="error-summary">

                        <strong>
                            Please check the following:
                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- FORM -->

                <form
                    action="{{ route('contact.message.store') }}"
                    method="POST"
                    class="contact-form"
                >

                    @csrf


                    <!-- NAME -->

                    <div class="form-group">

                        <label for="name">
                            Full Name
                        </label>

                        <div class="input-wrapper">

                            <span>
                                👤
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                            >

                        </div>

                        @error('name')

                            <small class="field-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="input-wrapper">

                            <span>
                                ✉️
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >

                        </div>

                        @error('email')

                            <small class="field-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- PHONE -->

                    <div class="form-group">

                        <label for="phone">
                            Phone Number
                        </label>

                        <div class="input-wrapper">

                            <span>
                                📱
                            </span>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="e.g. 07XXXXXXXX"
                            >

                        </div>

                        @error('phone')

                            <small class="field-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- SUBJECT -->

                    <div class="form-group">

                        <label for="subject">
                            Subject
                        </label>

                        <div class="input-wrapper">

                            <span>
                                📌
                            </span>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="What is your message about?"
                            >

                        </div>

                        @error('subject')

                            <small class="field-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- MESSAGE -->

                    <div class="form-group">

                        <label for="message">
                            Your Message
                        </label>

                        <div class="textarea-wrapper">

                            <span>
                                💬
                            </span>

                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="Write your message here..."
                                required
                            >{{ old('message') }}</textarea>

                        </div>

                        @error('message')

                            <small class="field-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- SEND BUTTON -->

                    <button
                        type="submit"
                        class="send-message-button"
                    >

                        <span>
                            ✉️
                        </span>

                        <span>
                            Send Message
                        </span>

                        <span>
                            →
                        </span>

                    </button>


                    <div class="form-security">

                        🔒 Your information is handled securely.

                    </div>

                </form>

            </div>

        </div>

    </section>


    <!-- =========================
         QUICK CONTACT SECTION
    ========================== -->

    <section class="quick-contact-section">

        <div class="quick-contact-container">

            <div class="quick-contact-text">

                <span>
                    NEED QUICK HELP?
                </span>

                <h2>
                    Talk To Us Directly
                </h2>

                <p>
                    For faster assistance, contact us through
                    WhatsApp or give us a call.
                </p>

            </div>


            <div class="quick-contact-buttons">

                <a
                    href="https://wa.me/255795651827?text=Hello%20Kessy%20Delicious%2C%20I%20need%20assistance."
                    target="_blank"
                    rel="noopener noreferrer"
                    class="quick-whatsapp"
                >
                    💬 WhatsApp
                </a>

                <a
                    href="tel:+255634887763"
                    class="quick-call"
                >
                    📞 Call Us
                </a>

            </div>

        </div>

    </section>

</div>


<style>

/* =========================================
   CONTACT PAGE
========================================= */

.contact-page {
    background: #f8fafc;
}


/* =========================================
   HERO
========================================= */

.contact-hero {
    position: relative;

    min-height: 430px;

    display: flex;

    align-items: center;

    justify-content: center;

    text-align: center;

    background-image:
        linear-gradient(
            135deg,
            rgba(15, 23, 42, .88),
            rgba(15, 23, 42, .60)
        ),
        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1800&q=85');
}


.contact-hero-content {
    position: relative;

    z-index: 2;

    max-width: 800px;

    padding: 50px 25px;

    color: white;
}


.hero-badge {
    display: inline-block;

    padding: 8px 15px;

    border-radius: 50px;

    background: rgba(255, 255, 255, .12);

    border: 1px solid rgba(255, 255, 255, .25);

    backdrop-filter: blur(8px);

    font-size: .8rem;

    font-weight: 800;

    letter-spacing: 1.5px;

    margin-bottom: 20px;
}


.contact-hero h1 {
    margin: 0;

    font-family: 'Space Grotesk', sans-serif;

    font-size: clamp(2.4rem, 6vw, 4.5rem);

    font-weight: 800;

    line-height: 1.05;

    text-shadow:
        0 5px 25px rgba(0,0,0,.4);
}


.contact-hero p {
    max-width: 650px;

    margin: 20px auto 0;

    font-size: 1.05rem;

    line-height: 1.8;

    color: rgba(255,255,255,.88);
}


/* =========================================
   MAIN SECTION
========================================= */

.contact-section {
    padding: 90px 20px;
}


.contact-container {
    max-width: 1200px;

    margin: auto;

    display: grid;

    grid-template-columns:
        minmax(0, .9fr)
        minmax(0, 1.1fr);

    gap: 70px;

    align-items: start;
}


/* =========================================
   SECTION HEADING
========================================= */

.section-heading > span,
.form-header > span,
.quick-contact-text > span {

    display: inline-block;

    color: #2563eb;

    font-size: .78rem;

    font-weight: 800;

    letter-spacing: 2px;

    margin-bottom: 10px;
}


.section-heading h2,
.form-header h2 {

    margin: 0;

    color: #0f172a;

    font-family: 'Space Grotesk', sans-serif;

    font-size: clamp(1.8rem, 4vw, 2.8rem);

    line-height: 1.15;
}


.section-heading p,
.form-header p {

    color: #64748b;

    line-height: 1.8;

    margin-top: 15px;
}


/* =========================================
   CONTACT CARDS
========================================= */

.contact-info {
    display: flex;

    flex-direction: column;

    gap: 14px;
}


.contact-card {
    display: flex;

    align-items: center;

    gap: 15px;

    padding: 18px;

    text-decoration: none;

    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 16px;

    color: inherit;

    box-shadow:
        0 8px 25px rgba(15,23,42,.04);

    transition: all .3s ease;
}


.contact-card:hover {
    transform: translateY(-3px);

    border-color: #bfdbfe;

    box-shadow:
        0 15px 35px rgba(15,23,42,.09);
}


.contact-icon {
    width: 52px;

    height: 52px;

    min-width: 52px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: #eff6ff;

    font-size: 1.35rem;
}


.whatsapp-icon {
    background: #ecfdf5;
}


.contact-card-content {
    min-width: 0;

    flex: 1;
}


.contact-card-content span {
    display: block;

    color: #64748b;

    font-size: .78rem;

    font-weight: 700;

    margin-bottom: 4px;
}


.contact-card-content strong {
    display: block;

    color: #0f172a;

    font-size: .98rem;

    overflow-wrap: anywhere;
}


.contact-card-content small {
    display: block;

    color: #94a3b8;

    margin-top: 3px;
}


.contact-arrow {
    color: #94a3b8;

    font-size: 1.3rem;

    transition: transform .2s ease;
}


.contact-card:hover .contact-arrow {
    transform: translateX(4px);

    color: #2563eb;
}


/* =========================================
   WHATSAPP BUTTON
========================================= */

.whatsapp-button {
    margin-top: 8px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;

    padding: 15px 20px;

    border-radius: 12px;

    background: #16a34a;

    color: white;

    text-decoration: none;

    font-weight: 800;

    box-shadow:
        0 10px 25px rgba(22,163,74,.18);

    transition: all .3s ease;
}


.whatsapp-button:hover {
    background: #15803d;

    transform: translateY(-2px);

    color: white;
}


.whatsapp-button-icon {
    font-size: 1.2rem;
}


/* =========================================
   FORM WRAPPER
========================================= */

.contact-form-wrapper {
    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 24px;

    padding: 35px;

    box-shadow:
        0 20px 60px rgba(15,23,42,.07);
}


.form-header {
    margin-bottom: 25px;
}


/* =========================================
   SUCCESS MESSAGE
========================================= */

.success-message {
    display: flex;

    align-items: flex-start;

    gap: 12px;

    padding: 15px;

    margin-bottom: 22px;

    border-radius: 12px;

    background: #ecfdf5;

    border: 1px solid #a7f3d0;

    color: #166534;
}


.success-icon {
    width: 30px;

    height: 30px;

    min-width: 30px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #16a34a;

    color: white;

    font-weight: 800;
}


.success-message strong {
    display: block;

    margin-bottom: 3px;
}


.success-message p {
    margin: 0;

    font-size: .9rem;

    line-height: 1.5;
}


/* =========================================
   ERROR SUMMARY
========================================= */

.error-summary {
    padding: 15px;

    margin-bottom: 20px;

    border-radius: 12px;

    background: #fef2f2;

    border: 1px solid #fecaca;

    color: #991b1b;

    font-size: .9rem;
}


.error-summary ul {
    margin: 8px 0 0;

    padding-left: 20px;
}


/* =========================================
   FORM
========================================= */

.contact-form {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 20px;
}


.form-group {
    display: flex;

    flex-direction: column;
}


.form-group:nth-child(5),
.send-message-button,
.form-security {
    grid-column: 1 / -1;
}


.form-group label {
    margin-bottom: 8px;

    color: #334155;

    font-size: .9rem;

    font-weight: 700;
}


.input-wrapper,
.textarea-wrapper {
    position: relative;
}


.input-wrapper > span,
.textarea-wrapper > span {
    position: absolute;

    left: 15px;

    top: 50%;

    transform: translateY(-50%);

    z-index: 2;

    font-size: 1rem;
}


.textarea-wrapper > span {
    top: 18px;

    transform: none;
}


.input-wrapper input,
.textarea-wrapper textarea {
    width: 100%;

    box-sizing: border-box;

    border: 1px solid #e2e8f0;

    background: #f8fafc;

    border-radius: 11px;

    padding: 13px 15px 13px 45px;

    color: #0f172a;

    font-family: inherit;

    font-size: .95rem;

    outline: none;

    transition: all .25s ease;
}


.textarea-wrapper textarea {
    resize: vertical;

    min-height: 145px;

    line-height: 1.6;
}


.input-wrapper input:focus,
.textarea-wrapper textarea:focus {
    background: white;

    border-color: #2563eb;

    box-shadow:
        0 0 0 4px rgba(37,99,235,.09);
}


.input-wrapper input::placeholder,
.textarea-wrapper textarea::placeholder {
    color: #94a3b8;
}


.field-error {
    color: #dc2626;

    margin-top: 6px;

    font-size: .78rem;
}


/* =========================================
   SEND BUTTON
========================================= */

.send-message-button {
    border: none;

    cursor: pointer;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 12px;

    padding: 15px 20px;

    border-radius: 12px;

    background: #2563eb;

    color: white;

    font-family: inherit;

    font-size: .95rem;

    font-weight: 800;

    box-shadow:
        0 10px 25px rgba(37,99,235,.18);

    transition: all .3s ease;
}


.send-message-button:hover {
    background: #1d4ed8;

    transform: translateY(-2px);

    box-shadow:
        0 15px 30px rgba(37,99,235,.25);
}


.send-message-button:active {
    transform: translateY(0);
}


/* =========================================
   SECURITY
========================================= */

.form-security {
    text-align: center;

    color: #94a3b8;

    font-size: .78rem;
}


/* =========================================
   QUICK CONTACT
========================================= */

.quick-contact-section {
    padding: 0 20px 90px;
}


.quick-contact-container {
    max-width: 1160px;

    margin: auto;

    padding: 45px;

    border-radius: 24px;

    background:
        linear-gradient(
            135deg,
            #0f172a,
            #1e293b
        );

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

    color: white;
}


.quick-contact-text h2 {
    margin: 0;

    font-family: 'Space Grotesk', sans-serif;

    font-size: 2rem;
}


.quick-contact-text p {
    margin: 10px 0 0;

    color: #cbd5e1;

    line-height: 1.6;
}


.quick-contact-buttons {
    display: flex;

    gap: 12px;

    flex-wrap: wrap;
}


.quick-contact-buttons a {
    text-decoration: none;

    padding: 13px 20px;

    border-radius: 10px;

    font-weight: 800;

    transition: all .25s ease;
}


.quick-whatsapp {
    background: #16a34a;

    color: white;
}


.quick-whatsapp:hover {
    background: #15803d;

    color: white;

    transform: translateY(-2px);
}


.quick-call {
    background: white;

    color: #0f172a;
}


.quick-call:hover {
    background: #e2e8f0;

    color: #0f172a;

    transform: translateY(-2px);
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 950px) {

    .contact-container {
        grid-template-columns: 1fr;

        max-width: 750px;

        gap: 45px;
    }


    .contact-form-wrapper {
        padding: 30px;
    }

}


@media (max-width: 700px) {

    .contact-section {
        padding: 65px 16px;
    }


    .contact-form {
        grid-template-columns: 1fr;
    }


    .form-group:nth-child(5),
    .send-message-button,
    .form-security {
        grid-column: auto;
    }


    .quick-contact-section {
        padding: 0 16px 65px;
    }


    .quick-contact-container {
        padding: 30px 24px;

        flex-direction: column;

        align-items: flex-start;
    }


    .quick-contact-buttons {
        width: 100%;
    }


    .quick-contact-buttons a {
        flex: 1;

        text-align: center;
    }

}


@media (max-width: 500px) {

    .contact-hero {
        min-height: 380px;
    }


    .contact-hero-content {
        padding: 40px 18px;
    }


    .contact-form-wrapper {
        padding: 22px 18px;

        border-radius: 18px;
    }


    .contact-card {
        padding: 14px;
    }


    .contact-icon {
        width: 45px;

        height: 45px;

        min-width: 45px;
    }


    .contact-card-content strong {
        font-size: .88rem;
    }


    .whatsapp-button {
        font-size: .88rem;
    }

}

</style>

@endsection