<!DOCTYPE html>
<html lang="en">

<head>

    {{-- BASIC META --}}
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="@yield('description', 'Kessy Brothers Food - fresh meals, delicious flavors and friendly service.')"
    >

    <meta
        name="theme-color"
        content="#2563eb"
    >


    {{-- PAGE TITLE --}}
    <title>
        @yield('title', 'Kessy Brothers Food')
    </title>


    {{-- FAVICON --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('favicon.png') }}"
    >

    <link
        rel="shortcut icon"
        type="image/png"
        href="{{ asset('favicon.png') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('favicon.png') }}"
    >


    {{-- GOOGLE FONTS --}}
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    {{-- CUSTOM PAGE STYLES --}}
    @stack('styles')


    <style>

        /* =====================================================
           GLOBAL RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.6;
            overflow-x: hidden;
        }


        img {
            max-width: 100%;
            display: block;
        }


        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }


        a {
            color: inherit;
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        #main-content {
            min-height: 70vh;
            padding-top: 78px;
        }


        /* =====================================================
           TYPOGRAPHY
        ===================================================== */

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Space Grotesk', sans-serif;
        }


        /* =====================================================
           BUTTONS
        ===================================================== */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 13px 22px;

            border-radius: 10px;

            text-decoration: none;

            font-weight: 700;

            border: none;

            cursor: pointer;

            transition:
                transform .25s ease,
                background .25s ease,
                box-shadow .25s ease;
        }


        .btn-primary {
            background: #c89b3c;
            color: #0f172a;
        }


        .btn-primary:hover {
            background: #b88a2a;
            transform: translateY(-2px);

            box-shadow:
                0 10px 25px rgba(200, 155, 60, .28);
        }


        .btn-secondary {
            background: #16263d;
            color: white;
        }


        .btn-secondary:hover {
            background: #0d1c2f;
            transform: translateY(-2px);

            box-shadow:
                0 10px 25px rgba(22, 38, 61, .25);
        }


        .btn-dark {
            background: #0f172a;
            color: white;
        }


        .btn-dark:hover {
            background: #1e293b;
            transform: translateY(-2px);
        }


        /* =====================================================
           CARDS
        ===================================================== */

        .card {
            background: white;

            border-radius: 18px;

            border: 1px solid #e2e8f0;

            box-shadow:
                0 10px 35px rgba(15, 23, 42, .06);

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }


        .card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 18px 45px rgba(15, 23, 42, .10);
        }


        /* =====================================================
           FORMS
        ===================================================== */

        .form-group {
            margin-bottom: 20px;
        }


        .form-group label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-weight: 700;

            font-size: 14px;
        }


        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;

            padding: 13px 15px;

            border: 1px solid #cbd5e1;

            border-radius: 10px;

            background: white;

            color: #0f172a;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .10);
        }


        /* =====================================================
           ALERTS
        ===================================================== */

        .alert {
            padding: 14px 18px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-weight: 600;
        }


        .alert-success {
            background: #dcfce7;
            color: #166534;
        }


        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }


        .alert-info {
            background: #dbeafe;
            color: #1e40af;
        }


        /* =====================================================
           ANIMATIONS
        ===================================================== */

        @keyframes fadeUp {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        @keyframes fadeIn {

            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }

        }


        @keyframes pageEnter {

            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        .page-transition {
            position: fixed;
            inset: 0;
            z-index: 100000;
            background: #0f172a;
            pointer-events: none;
            display: grid;
            place-items: center;
            transform: translateY(0);
            transition: transform .7s cubic-bezier(.76, 0, .24, 1);
        }


        .page-transition.is-ready {
            transform: translateY(-100%);
        }


        .page-transition-brand {
            display: grid;
            gap: 16px;
            color: #ffffff;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: .5px;
            opacity: 1;
            transform: translateY(0);
            transition: opacity .25s ease, transform .45s ease;
        }


        .page-transition.is-ready .page-transition-brand {
            opacity: 0;
            transform: translateY(-12px);
        }


        .page-transition-brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            margin: 0 auto;
            filter: drop-shadow(0 10px 22px rgba(255, 99, 56, .25));
        }


        .page-transition-progress {
            width: min(180px, 46vw);
            height: 2px;
            overflow: hidden;
            background: rgba(255, 255, 255, .18);
        }


        .page-transition-progress span {
            display: block;
            width: 42%;
            height: 100%;
            background: #ff6338;
            animation: pageProgress 1s cubic-bezier(.22, 1, .36, 1) infinite;
        }


        @keyframes pageProgress {

            from {
                transform: translateX(-140%);
            }

            to {
                transform: translateX(340%);
            }

        }


        body.page-ready #main-content,
        body.page-ready .food-footer {
            animation: pageEnter .6s cubic-bezier(.22, 1, .36, 1) both;
        }


        body.page-leaving .page-transition {
            opacity: 1;
        }


        .fade-up {
            animation: fadeUp .7s ease both;
        }


        .fade-in {
            animation: fadeIn .7s ease both;
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .container {
            width: min(1200px, calc(100% - 40px));

            margin: auto;
        }


        /* =====================================================
           SECTIONS
        ===================================================== */

        .section {
            padding: 80px 0;
        }


        .section-title {
            text-align: center;

            margin-bottom: 45px;
        }


        .section-title span {
            display: block;

            color: #2563eb;

            font-size: 13px;

            font-weight: 800;

            letter-spacing: 2px;

            margin-bottom: 8px;
        }


        .section-title h2 {
            font-size: clamp(30px, 5vw, 46px);

            color: #0f172a;
        }


        .section-title p {
            max-width: 650px;

            margin: 12px auto 0;

            color: #64748b;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 768px) {

            #main-content {
                padding-top: 70px;
            }


            .container {
                width: min(100% - 30px, 1200px);
            }


            .section {
                padding: 60px 0;
            }


            .section-title {
                margin-bottom: 30px;
            }

        }


        /* =====================================================
           REDUCED MOTION
        ===================================================== */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;

                animation-duration: .01ms !important;

                animation-iteration-count: 1 !important;

                transition-duration: .01ms !important;
            }

        }

    </style>

</head>


<body>

    <div class="page-transition" aria-hidden="true">
        <div class="page-transition-brand">
            <img src="{{ asset('favicon.png') }}" alt="Kessy Brothers Food logo">
            Kessy Brothers Food
            <div class="page-transition-progress">
                <span></span>
            </div>
        </div>
    </div>


    {{-- NAVBAR --}}
    @includeIf('components.navbar')


    {{-- MAIN CONTENT --}}
    <main id="main-content">

        @yield('content')

    </main>


    {{-- FOOTER --}}
    @includeIf('components.footer')


    {{-- CUSTOM PAGE SCRIPTS --}}
    @stack('scripts')


</body>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const transition = document.querySelector('.page-transition');

        if (!transition) {
            return;
        }

        requestAnimationFrame(function () {
            transition.classList.add('is-ready');
            document.body.classList.add('page-ready');
        });

        document.addEventListener('click', function (event) {

            const link = event.target.closest('a');

            if (!link || event.defaultPrevented || event.button !== 0) {
                return;
            }

            if (
                link.target === '_blank' ||
                link.hasAttribute('download') ||
                link.origin !== window.location.origin ||
                link.pathname === window.location.pathname && link.hash
            ) {
                return;
            }

            event.preventDefault();
            document.body.classList.add('page-leaving');
            transition.classList.remove('is-ready');

            window.setTimeout(function () {
                window.location.href = link.href;
            }, 300);

        });

    });

</script>

</html>