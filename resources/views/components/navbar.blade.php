<nav class="main-navbar" id="mainNavbar">

    <div class="navbar-container">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="navbar-logo">
            <img
                class="logo-icon"
                src="{{ asset('images/kessy-tech-pro-logo.png') }}"
                alt="Kessy Tech Pro logo"
            >
            <span>
                <strong>Kessy Brothers</strong>
                <small>Food</small>
            </span>
        </a>


        {{-- DESKTOP NAVIGATION --}}
        <div class="desktop-nav">

            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'active' : '' }}">
                Home
            </a>

            <a href="{{ url('/about') }}"
               class="{{ request()->is('about') ? 'active' : '' }}">
                About
            </a>

            <a href="{{ url('/menu') }}"
               class="{{ request()->is('menu') ? 'active' : '' }}">
                Menu
            </a>

            <a href="{{ url('/contact') }}"
               class="{{ request()->is('contact') ? 'active' : '' }}">
                Contact
            </a>

            {{-- ADMIN DROPDOWN --}}
            @auth
                @if(auth()->user()->isAdmin())
            <div class="admin-menu">

                <button type="button" class="admin-toggle">
                    ⚙️ Admin
                    <span class="arrow">⌄</span>
                </button>

                <div class="admin-dropdown">

                    <a href="{{ route('admin.dashboard') }}">
                        📊 Admin Dashboard
                    </a>

                    <a href="{{ route('admin.orders.index') }}">
                        📦 Customer Orders
                    </a>

                    <a href="{{ route('admin.users.index') }}">
                        👥 Manage Customers
                    </a>

                    <a href="{{ route('admin.messages.index') }}">
                        📨 Messages
                    </a>

                    <a href="{{ route('foods.index') }}">
                        🍔 Manage Foods
                    </a>

                </div>

            </div>
                @endif
            @endauth

            @auth
                <a href="{{ route('dashboard') }}">My Account</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth

            <a href="{{ route('order') }}" class="order-button">
                Order Food
            </a>

        </div>


        {{-- MOBILE BUTTON --}}
        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Open menu"
            aria-expanded="false"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>


    {{-- MOBILE NAVIGATION --}}
    <div class="mobile-nav" id="mobileNav">

        <a href="{{ url('/') }}">
            🏠 Home
        </a>

        <a href="{{ url('/about') }}">
            ℹ️ About
        </a>

        <a href="{{ url('/menu') }}">
            🍽️ Menu
        </a>

        <a href="{{ url('/contact') }}">
            📞 Contact
        </a>

        @auth
            @if(auth()->user()->isAdmin())
        <div class="mobile-admin-title">
            ⚙️ Admin Panel
        </div>

        <a href="{{ route('admin.dashboard') }}">
            📊 Admin Dashboard
        </a>

        <a href="{{ route('admin.orders.index') }}">
            📦 Customer Orders
        </a>

        <a href="{{ route('admin.users.index') }}">
            👥 Manage Customers
        </a>

        <a href="{{ route('admin.messages.index') }}">
            📨 Messages
        </a>

        <a href="{{ route('foods.index') }}">
            🍔 Manage Foods
        </a>
            @endif
        @endauth

        @auth
            <a href="{{ route('dashboard') }}">👤 My Account</a>
        @else
            <a href="{{ route('login') }}">🔐 Login</a>
        @endauth

        <a href="{{ route('order') }}" class="mobile-order-button">
            🛒 Order Food
        </a>

    </div>

</nav>


<style>

.main-navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    background: rgba(17, 27, 43, 0.96);
    backdrop-filter: blur(15px);
    border-bottom: 1px solid rgba(243, 154, 30, 0.25);
    transition: all 0.3s ease;
}

.main-navbar.navbar-scrolled {
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.10);
}

.navbar-container {
    max-width: 1250px;
    margin: auto;
    padding: 15px 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #f8fafc;
}

.logo-icon {
    width: 42px;
    height: 42px;
    object-fit: contain;
}

.navbar-logo strong {
    display: block;
    font-family: 'Space Grotesk', sans-serif;
    font-size: 21px;
    font-weight: 800;
    line-height: 1;
}

.navbar-logo small {
    display: block;
    color: var(--brand-accent);
    font-size: 12px;
    font-weight: 700;
    margin-top: 3px;
}

.desktop-nav {
    display: flex;
    align-items: center;
    gap: 7px;
}

.desktop-nav > a,
.admin-toggle {
    border: none;
    background: transparent;
    color: #e2e8f0;
    text-decoration: none;
    padding: 10px 13px;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
}

.desktop-nav > a:hover,
.admin-toggle:hover {
    color: var(--brand-secondary);
    background: rgba(32, 169, 212, 0.10);
}

.desktop-nav > a.active {
    color: var(--brand-secondary);
}

.admin-menu {
    position: relative;
}

.admin-toggle {
    display: flex;
    align-items: center;
    gap: 5px;
}

.arrow {
    font-size: 16px;
    transition: transform 0.25s ease;
}

.admin-menu:hover .arrow {
    transform: rotate(180deg);
}

.admin-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    width: 230px;
    background: #f8f5ee;
    border: 1px solid rgba(243, 154, 30, 0.2);
    border-radius: 13px;
    padding: 8px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.15);

    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);

    transition: all 0.2s ease;
}

.admin-menu:hover .admin-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.admin-dropdown a {
    display: block;
    padding: 12px 13px;
    border-radius: 9px;
    color: #1f2937;
    text-decoration: none;
    font-size: 14px;
    font-weight: 650;
    transition: all 0.2s ease;
}

.admin-dropdown a:hover {
    background: rgba(243, 154, 30, 0.12);
    color: #0f172a;
}

.order-button {
    background: var(--brand-secondary) !important;
    color: var(--brand-primary) !important;
    padding: 11px 18px !important;
    margin-left: 5px;
    box-shadow: 0 10px 20px rgba(243, 154, 30, 0.25);
}

.order-button:hover {
    background: var(--brand-secondary-dark) !important;
    color: var(--brand-primary) !important;
    transform: translateY(-1px);
}


/* MOBILE BUTTON */

.mobile-menu-button {
    display: none;
    width: 44px;
    height: 44px;
    border: none;
    border-radius: 10px;
    background: rgba(243, 154, 30, 0.12);
    cursor: pointer;
    padding: 9px;
}

.mobile-menu-button span {
    display: block;
    height: 2px;
    background: var(--brand-secondary);
    margin: 5px 0;
    border-radius: 5px;
}


/* MOBILE NAV */

.mobile-nav {
    display: none;
    padding: 10px 20px 22px;
    background: #0f172a;
    border-top: 1px solid rgba(243, 154, 30, 0.2);
}

.mobile-nav a {
    display: block;
    text-decoration: none;
    color: #e2e8f0;
    padding: 13px 12px;
    border-radius: 9px;
    font-size: 15px;
    font-weight: 700;
}

.mobile-nav a:hover {
    background: rgba(243, 154, 30, 0.08);
    color: var(--brand-secondary);
}

.mobile-admin-title {
    margin-top: 8px;
    padding: 13px 12px 7px;
    color: var(--brand-secondary);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
}

.mobile-order-button {
    background: var(--brand-secondary) !important;
    color: var(--brand-primary) !important;
    text-align: center;
    margin-top: 8px;
}


/* MOBILE */

@media (max-width: 900px) {

    .desktop-nav {
        display: none;
    }

    .mobile-menu-button {
        display: block;
    }

    .mobile-nav.show {
        display: block;
    }

    .navbar-container {
        padding: 13px 18px;
    }

    .logo-icon {
        font-size: 30px;
    }

    .navbar-logo strong {
        font-size: 19px;
    }

}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const navbar = document.getElementById('mainNavbar');

    const mobileButton =
        document.getElementById('mobileMenuButton');

    const mobileNav =
        document.getElementById('mobileNav');


    /* NAVBAR SHADOW ON SCROLL */

    function updateNavbar() {

        if (window.scrollY > 20) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }

    }

    window.addEventListener('scroll', updateNavbar);

    updateNavbar();


    /* MOBILE MENU */

    mobileButton.addEventListener('click', function () {

        const isOpen =
            mobileNav.classList.toggle('show');

        mobileButton.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );

    });


    /* CLOSE MOBILE MENU AFTER CLICK */

    mobileNav.querySelectorAll('a').forEach(function (link) {

        link.addEventListener('click', function () {

            mobileNav.classList.remove('show');

            mobileButton.setAttribute(
                'aria-expanded',
                'false'
            );

        });

    });

});

</script>