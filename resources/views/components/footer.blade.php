<footer class="food-footer">

    <!-- ================= BACKGROUND SLIDES ================= -->
    <div class="footer-slides">

           <div class="footer-slide active"
               data-caption="Signature burgers"
               style="background-image:url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=2000&q=85');">
        </div>

           <div class="footer-slide"
               data-caption="Freshly baked pizza"
               style="background-image:url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=2000&q=85');">
        </div>

           <div class="footer-slide"
               data-caption="Creamy pasta favorites"
               style="background-image:url('https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=2000&q=85');">
        </div>

           <div class="footer-slide"
               data-caption="Grilled with care"
               style="background-image:url('https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=2000&q=85');">
        </div>

    </div>


    <!-- ================= DARK OVERLAY ================= -->
    <div class="footer-overlay"></div>

    <div class="footer-slide-info" aria-live="polite">
        <span>Fresh from our kitchen</span>
        <strong id="footerSlideCaption">Signature burgers</strong>
    </div>

    <div class="footer-slide-controls" role="tablist" aria-label="Food gallery">
        <button class="footer-slide-dot active" type="button" role="tab" aria-label="Show signature burgers" aria-selected="true" data-slide="0"></button>
        <button class="footer-slide-dot" type="button" role="tab" aria-label="Show freshly baked pizza" aria-selected="false" data-slide="1"></button>
        <button class="footer-slide-dot" type="button" role="tab" aria-label="Show creamy pasta favorites" aria-selected="false" data-slide="2"></button>
        <button class="footer-slide-dot" type="button" role="tab" aria-label="Show grilled with care" aria-selected="false" data-slide="3"></button>
    </div>


    <!-- ================= MAIN FOOTER ================= -->
    <div class="footer-container">


        <!-- ================= BRAND ================= -->
        <div class="footer-brand">

            <a href="{{ url('/') }}" class="footer-logo">
                <img src="{{ asset('favicon.png') }}" alt="Kessy Brothers Food logo">
                <span>Kessy Brothers Food</span>
            </a>

            <p>
                Fresh, delicious meals prepared with care and delivered with
                friendly service for every customer.
            </p>


            <!-- SOCIAL / CONTACT BUTTONS -->
            <div class="footer-social">

                <!-- WHATSAPP -->
                <a
                    href="https://wa.me/255795651827"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="WhatsApp">

                    <span>💬</span>

                </a>


                <!-- EMAIL -->
                <a
                    href="mailto:perfectkessy2005@gmail.com"
                    aria-label="Email">

                    <span>✉</span>

                </a>


                <!-- PHONE -->
                <a
                    href="tel:+255634887763"
                    aria-label="Call us">

                    <span>📞</span>

                </a>

            </div>

        </div>



        <!-- ================= QUICK LINKS ================= -->
        <div class="footer-column">

            <h3>Quick Links</h3>

            <ul>

                <li>
                    <a href="{{ url('/') }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ url('/about') }}">
                        About Us
                    </a>
                </li>

                <li>
                    <a href="{{ url('/menu') }}">
                        Food Menu
                    </a>
                </li>

                <li>
                    <a href="{{ url('/') }}#popular-foods">
                        Popular Meals
                    </a>
                </li>

                <li>
                    <a href="{{ url('/contact') }}">
                        Contact
                    </a>
                </li>

                <li>
                    <a href="{{ url('/order') }}">
                        Order Food
                    </a>
                </li>

            </ul>

        </div>



        <!-- ================= FOOD CATEGORIES ================= -->
        <div class="footer-column">

            <h3>Food Categories</h3>

            <ul>

                <li>
                    <a href="{{ url('/menu') }}#foodGrid">
                        🍔 Burgers
                    </a>
                </li>

                <li>
                    <a href="{{ url('/menu') }}#foodGrid">
                        🍕 Pizza
                    </a>
                </li>

                <li>
                    <a href="{{ url('/menu') }}#foodGrid">
                        🍗 Grilled Meals
                    </a>
                </li>

                <li>
                    <a href="{{ url('/menu') }}#foodGrid">
                        🍝 Pasta
                    </a>
                </li>

                <li>
                    <a href="{{ url('/menu') }}#foodGrid">
                        🥗 Fresh Meals
                    </a>
                </li>

            </ul>

        </div>



        <!-- ================= CONTACT ================= -->
        <div class="footer-column footer-contact">

            <h3>Get In Touch</h3>


            <!-- LOCATION -->
            <div class="contact-item">

                <span class="contact-icon">
                    📍
                </span>

                <div>

                    <strong>Location</strong>

                    <p>
                        Shant Town, Moshi, Tanzania
                    </p>

                </div>

            </div>



            <!-- PHONE -->
            <div class="contact-item">

                <span class="contact-icon">
                    📞
                </span>

                <div>

                    <strong>Phone</strong>

                    <p>

                        <a href="tel:+255634887763">

                            0634887763

                        </a>

                    </p>

                </div>

            </div>



            <!-- WHATSAPP -->
            <div class="contact-item">

                <span class="contact-icon">
                    💬
                </span>

                <div>

                    <strong>WhatsApp</strong>

                    <p>

                        <a
                            href="https://wa.me/255795651827"
                            target="_blank"
                            rel="noopener noreferrer">

                            0795651827

                        </a>

                    </p>

                </div>

            </div>



            <!-- EMAIL -->
            <div class="contact-item">

                <span class="contact-icon">
                    ✉
                </span>

                <div>

                    <strong>Email</strong>

                    <p>

                        <a href="mailto:perfectkessy2005@gmail.com">

                            perfectkessy2005@gmail.com

                        </a>

                    </p>

                </div>

            </div>



            <!-- OPENING HOURS -->
            <div class="contact-item">

                <span class="contact-icon">
                    🕐
                </span>

                <div>

                    <strong>Opening Hours</strong>

                    <p>
                        Open Daily<br>
                        08:00 AM – 10:00 PM
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- ================= NEWSLETTER ================= -->
    <div class="footer-newsletter">

        <div class="newsletter-content">

            <div>

                <h3>
                    Stay Updated 🍽️
                </h3>

                <p>
                    Get updates about our latest meals,
                    special offers and delicious meals.
                </p>

            </div>


            <form id="newsletterForm">

                <input
                    type="email"
                    id="newsletterEmail"
                    placeholder="Enter your email"
                    required
                >

                <button type="submit">
                    Subscribe
                </button>

            </form>

        </div>

    </div>



    <!-- ================= BOTTOM FOOTER ================= -->
    <div class="footer-bottom">

        <p>

            © {{ date('Y') }}

            <strong>
                    Kessy Brothers Food
            </strong>.

            All Rights Reserved.

        </p>


        <div class="footer-bottom-links">

            <a href="{{ url('/about') }}">
                About
            </a>

            <a href="{{ url('/contact') }}">
                Contact
            </a>

            <a href="{{ url('/order') }}">
                Order
            </a>

        </div>

    </div>

</footer>



<style>

/* =====================================================
   FOOTER
===================================================== */

.food-footer {

    position: relative;

    overflow: hidden;

    color: #ffffff;

    background: #0b1220;

}


/* =====================================================
   BACKGROUND SLIDES
===================================================== */

.footer-slides {

    position: absolute;

    inset: 0;

    z-index: 0;

}


.footer-slide {

    position: absolute;

    inset: 0;

    background-size: cover;

    background-position: center;

    opacity: 0;

    transform: scale(1.05);

    transition:
        opacity 1.5s ease,
        transform 7s ease;

    filter: saturate(1.12) contrast(1.05);

}


.footer-slide.active {

    opacity: 1;

    transform: scale(1);

}


/* =====================================================
   DARK OVERLAY
===================================================== */

.footer-overlay {

    position: absolute;

    inset: 0;

    z-index: 1;

    background:
        linear-gradient(90deg, rgba(5, 10, 20, .96) 0%, rgba(5, 10, 20, .78) 48%, rgba(5, 10, 20, .54) 100%),
        linear-gradient(0deg, rgba(5, 10, 20, .92) 0%, transparent 42%);

}


.footer-slide-info {

    position: absolute;

    right: 25px;

    top: 28px;

    z-index: 2;

    display: grid;

    gap: 4px;

    text-align: right;

    text-transform: uppercase;

    letter-spacing: 1.8px;

}


.footer-slide-info span {

    color: #ffb38f;

    font-size: 10px;

    font-weight: 800;

}


.footer-slide-info strong {

    color: rgba(255, 255, 255, .92);

    font-size: 12px;

}


.footer-slide-controls {

    position: absolute;

    right: 25px;

    top: 78px;

    z-index: 3;

    display: flex;

    gap: 8px;

}


.footer-slide-dot {

    width: 9px;

    height: 9px;

    padding: 0;

    border: 1px solid rgba(255, 255, 255, .75);

    border-radius: 50%;

    background: transparent;

    cursor: pointer;

    transition: .3s ease;

}


.footer-slide-dot:hover,
.footer-slide-dot.active {

    width: 28px;

    border-radius: 20px;

    border-color: #ff6338;

    background: #ff6338;


}


/* =====================================================
   MAIN CONTAINER
===================================================== */

.footer-container {

    position: relative;

    z-index: 2;

    max-width: 1250px;

    margin: auto;

    padding: 80px 25px 55px;

    display: grid;

    grid-template-columns:
        1.5fr
        1fr
        1fr
        1.5fr;

    gap: 55px;

}


/* =====================================================
   BRAND
===================================================== */

.footer-brand {

    max-width: 350px;

}


.footer-logo {

    display: inline-flex;
    align-items: center;
    gap: 10px;

    color: #ffffff;

    font-family:
        "Space Grotesk",
        sans-serif;

    font-size: 30px;

    font-weight: 800;

    text-decoration: none;

    margin-bottom: 18px;

}


.footer-logo img {
    width: 38px;
    height: 38px;
    object-fit: contain;
}


.footer-logo span {

    color: #d4af37;

}


.footer-brand p {

    color:
        rgba(255,255,255,.75);

    line-height: 1.8;

    font-size: 15px;

    margin-bottom: 25px;

}


/* =====================================================
   SOCIAL
===================================================== */

.footer-social {

    display: flex;

    gap: 12px;

}


.footer-social a {

    width: 43px;

    height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background:
        rgba(255,255,255,.10);

    color: #ffffff;

    text-decoration: none;

    border:
        1px solid
        rgba(255,255,255,.12);

    transition: .3s ease;

}


.footer-social a:hover {

    background: #d4af37;

    border-color: #d4af37;

    transform:
        translateY(-4px);

}


.footer-social span {

    font-size: 18px;

}


/* =====================================================
   FOOTER COLUMNS
===================================================== */

.footer-column h3 {

    position: relative;

    font-size: 18px;

    margin-bottom: 25px;

    color: #ffffff;

}


.footer-column h3::after {

    content: "";

    display: block;

    width: 40px;

    height: 3px;

    background: #ff6338;

    margin-top: 9px;

    border-radius: 10px;

}


.footer-column ul {

    list-style: none;

    margin: 0;

    padding: 0;

}


.footer-column li {

    margin-bottom: 13px;

}


.footer-column li a {

    color:
        rgba(255,255,255,.72);

    text-decoration: none;

    font-size: 14px;

    transition: .3s ease;

}


.footer-column li a:hover {

    color: #ff6338;

    padding-left: 6px;

}


/* =====================================================
   CONTACT
===================================================== */

.contact-item {

    display: flex;

    gap: 13px;

    margin-bottom: 19px;

}


.contact-icon {

    width: 35px;

    height: 35px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background:
        rgba(255,99,56,.12);

    border-radius: 8px;

    font-size: 16px;

}


.contact-item strong {

    display: block;

    font-size: 13px;

    color: #ffffff;

    margin-bottom: 3px;

}


.contact-item p {

    margin: 0;

    color:
        rgba(255,255,255,.70);

    font-size: 13px;

    line-height: 1.6;

}


.contact-item a {

    color:
        rgba(255,255,255,.70);

    text-decoration: none;

    transition: .3s ease;

}


.contact-item a:hover {

    color: #ff6338;

}


/* =====================================================
   NEWSLETTER
===================================================== */

.footer-newsletter {

    position: relative;

    z-index: 2;

    border-top:
        1px solid
        rgba(255,255,255,.10);

    border-bottom:
        1px solid
        rgba(255,255,255,.10);

}


.newsletter-content {

    max-width: 1250px;

    margin: auto;

    padding: 30px 25px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 30px;

}


.newsletter-content h3 {

    margin: 0 0 6px;

    font-size: 20px;

}


.newsletter-content p {

    margin: 0;

    color:
        rgba(255,255,255,.65);

    font-size: 14px;

}


.newsletter-content form {

    display: flex;

    width: 420px;

    max-width: 100%;

}


.newsletter-content input {

    flex: 1;

    min-width: 0;

    padding: 14px 16px;

    border: none;

    outline: none;

    border-radius:
        8px 0 0 8px;

    background: #ffffff;

    color: #111827;

    font-size: 14px;

}


.newsletter-content button {

    padding: 14px 20px;

    border: none;

    background: #ff6338;

    color: #ffffff;

    font-weight: 700;

    border-radius:
        0 8px 8px 0;

    cursor: pointer;

    transition: .3s ease;

}


.newsletter-content button:hover {

    background: #e94f28;

}


/* =====================================================
   BOTTOM
===================================================== */

.footer-bottom {

    position: relative;

    z-index: 2;

    max-width: 1250px;

    margin: auto;

    padding: 22px 25px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

}


.footer-bottom p {

    margin: 0;

    color:
        rgba(255,255,255,.55);

    font-size: 13px;

}


.footer-bottom strong {

    color: #ffffff;

}


.footer-bottom-links {

    display: flex;

    gap: 22px;

}


.footer-bottom-links a {

    color:
        rgba(255,255,255,.60);

    text-decoration: none;

    font-size: 13px;

    transition: .3s ease;

}


.footer-bottom-links a:hover {

    color: #ff6338;

}


/* =====================================================
   TABLET
===================================================== */

@media (max-width: 1000px) {

    .footer-container {

        grid-template-columns:
            1fr 1fr;

        gap: 45px;

    }

}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 700px) {

    .footer-container {

        grid-template-columns: 1fr;

        padding-top: 60px;

        gap: 38px;

    }


    .footer-brand {

        max-width: 100%;

    }


    .footer-slide-info {

        top: 22px;

        right: 20px;

    }


    .footer-slide-controls {

        top: 70px;

        right: 20px;

    }


    .newsletter-content {

        flex-direction: column;

        align-items: flex-start;

    }


    .newsletter-content form {

        width: 100%;

    }


    .footer-bottom {

        flex-direction: column;

        text-align: center;

    }


    .footer-bottom-links {

        justify-content: center;

    }

}


/* =====================================================
   SMALL MOBILE
===================================================== */

@media (max-width: 450px) {

    .footer-logo {

        font-size: 25px;

    }


    .newsletter-content form {

        flex-direction: column;

        gap: 10px;

    }


    .newsletter-content input,
    .newsletter-content button {

        width: 100%;

        border-radius: 8px;

    }

}

</style>



<script>

/* =====================================================
   FOOTER BACKGROUND SLIDESHOW
===================================================== */

document.addEventListener(
    "DOMContentLoaded",
    function () {


        const slides =
            document.querySelectorAll(
                ".footer-slide"
            );


        const slideDots = document.querySelectorAll(".footer-slide-dot");
        const slideCaption = document.getElementById("footerSlideCaption");

        function showSlide(index) {

            slides.forEach(function (slide, slideIndex) {
                slide.classList.toggle("active", slideIndex === index);
            });

            slideDots.forEach(function (dot, dotIndex) {
                const isActive = dotIndex === index;
                dot.classList.toggle("active", isActive);
                dot.setAttribute("aria-selected", isActive ? "true" : "false");
            });

            if (slideCaption) {
                slideCaption.textContent = slides[index].dataset.caption;
            }

            currentSlide = index;
        }

        slideDots.forEach(function (dot) {
            dot.addEventListener("click", function () {
                showSlide(Number(dot.dataset.slide));
            });
        });

        if (slides.length > 1) {

            let currentSlide = 0;


            setInterval(
                function () {


                    currentSlide =
                        (
                            currentSlide + 1
                        ) % slides.length;

                    showSlide(currentSlide);


                },
                5000
            );

        }



        /* =============================================
           NEWSLETTER
        ============================================= */

        const newsletter =
            document.getElementById(
                "newsletterForm"
            );


        if (newsletter) {


            newsletter.addEventListener(
                "submit",
                function (event) {

                    event.preventDefault();


                    const email =
                        document.getElementById(
                            "newsletterEmail"
                        ).value;


                    if (email.trim() !== "") {

                        alert(
                            "Thank you! Your email has been received. Newsletter service will be connected later."
                        );


                        document.getElementById(
                            "newsletterEmail"
                        ).value = "";

                    }

                }
            );

        }

    }
);

</script>