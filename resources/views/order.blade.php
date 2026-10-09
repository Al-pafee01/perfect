@extends('layouts.app')

@section('title', 'Order Food - Kessy Brothers Food')

@section('content')

<div class="order-page">

    <!-- HERO -->
    <section class="order-hero">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <span class="hero-badge">🍽️ KESSY BROTHERS FOOD</span>

            <h1>Order Your Favorite Food</h1>

            <p>
                Choose your favorite meals, select quantities,
                and place your order easily.
            </p>
        </div>
    </section>


    <!-- ORDER SECTION -->
    <section class="order-section">

        <div class="order-container">

            <!-- LEFT SIDE -->
            <div class="food-selection">

                <div class="section-heading">
                    <span>OUR MENU</span>
                    <h2>Choose Your Food</h2>
                    <p>Select the meals you want to order.</p>
                </div>


                <form
                    action="{{ route('order.store') }}"
                    method="POST"
                    id="orderForm"
                >

                    @csrf

                    @forelse($foods as $food)

                        @php($foodKey = 'food-' . $food->id)

                        <div
                            class="food-item"
                            data-food-id="{{ $food->id }}"
                            data-food-name="{{ $food->name }}"
                            data-food-price="{{ $food->price }}"
                        >

                            <div class="food-info">
                                <img class="food-item-image" src="{{ $food->image_url }}" alt="" loading="lazy">

                                <div>
                                    <h3>{{ $food->name }}</h3>
                                    <p>{{ $food->description }}</p>
                                    <strong>TSh {{ number_format($food->price) }}</strong>
                                </div>
                            </div>

                            <div class="quantity-box">
                                <button type="button" class="quantity-btn minus" data-target="{{ $foodKey }}">−</button>
                                <span id="{{ $foodKey }}-quantity">0</span>
                                <button type="button" class="quantity-btn plus" data-target="{{ $foodKey }}">+</button>
                            </div>

                            <input type="hidden" name="items[{{ $loop->index }}][food_id]" value="{{ $food->id }}">
                            <input type="hidden" name="items[{{ $loop->index }}][quantity]" id="{{ $foodKey }}-input" value="0">

                        </div>

                    @empty

                        <div class="empty-order">
                            <h3>No meals are available right now.</h3>
                            <p>Please check the menu again soon.</p>
                        </div>

                    @endforelse


                    <!-- CUSTOMER DETAILS -->

                    <div class="customer-details">

                        <div class="section-heading small-heading">
                            <span>DELIVERY DETAILS</span>

                            <h2>Your Information</h2>
                        </div>

                        <fieldset class="fulfillment-choice">
                            <legend>How would you like to receive your order?</legend>
                            <label>
                                <input type="radio" name="fulfillment_type" value="delivery"
                                    @checked(old('fulfillment_type', 'delivery') === 'delivery')>
                                Delivery
                            </label>
                            <small class="fulfillment-note">Any applicable delivery charge will be confirmed by the restaurant before preparation.</small>
                            <label>
                                <input type="radio" name="fulfillment_type" value="pickup"
                                    @checked(old('fulfillment_type') === 'pickup')>
                                Pickup
                            </label>
                            @error('fulfillment_type')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </fieldset>

                        <div class="form-group">

                            <label for="phone">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                placeholder="Enter your phone number"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                required
                            >

                            @error('phone')
                                <small class="error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="address">
                                Delivery Address
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Enter your delivery address"
                                autocomplete="street-address"
                                @required(old('fulfillment_type', 'delivery') === 'delivery')
                            >{{ old('address') }}</textarea>

                            @error('address')
                                <small class="error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="notes">
                                Additional Notes
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                                rows="3"
                                placeholder="Any special instructions? (Optional)"
                            >{{ old('notes') }}</textarea>

                            @error('notes')
                                <small class="error">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>


                    <!-- SUBMIT -->

                    <button
                        type="submit"
                        class="confirm-order"
                        id="confirmOrder"
                    >

                        <span>🛒</span>

                        Confirm Order

                    </button>

                </form>

            </div>


            <!-- RIGHT SIDE -->
            <aside class="order-summary">

                <div class="summary-card">

                    <div class="summary-header">

                        <span>Your Order</span>

                        <div class="cart-icon">
                            🛒
                        </div>

                    </div>


                    <div
                        id="summaryItems"
                        class="summary-items"
                    >

                        <div class="empty-order">
                            <div>🍽️</div>

                            <p>
                                Your order is empty.
                            </p>

                            <small>
                                Select food from the menu.
                            </small>
                        </div>

                    </div>


                    <div class="summary-total">

                        <span>Total</span>

                        <strong id="grandTotal">
                            TSh 0
                        </strong>

                    </div>


                    <div class="summary-note">

                        🔒 Your order is securely saved
                        after confirmation.

                    </div>

                </div>

            </aside>

        </div>

    </section>

</div>


<style>

.order-page {
    background: #f8fafc;
    min-height: 100vh;
}


/* HERO */

.order-hero {
    position: relative;
    min-height: 390px;

    background-image:
        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1800&q=85');

    background-size: cover;
    background-position: center;

    display: flex;
    align-items: center;
    justify-content: center;

    text-align: center;
}

.hero-overlay {
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            rgba(15, 23, 42, .78),
            rgba(15, 23, 42, .68)
        );
}

.hero-content {
    position: relative;
    z-index: 2;

    max-width: 800px;
    padding: 40px 20px;

    color: white;
}

.hero-badge {
    display: inline-block;

    padding: 9px 18px;

    border-radius: 50px;

    background: rgba(255,255,255,.15);

    border: 1px solid rgba(255,255,255,.3);

    font-size: 13px;
    font-weight: 700;

    letter-spacing: 1px;
}

.hero-content h1 {
    margin: 20px 0 12px;

    font-size: clamp(38px, 6vw, 64px);

    font-weight: 800;

    font-family: 'Space Grotesk', sans-serif;
}

.hero-content p {
    margin: 0;

    font-size: 18px;

    color: rgba(255,255,255,.88);
}


/* ORDER SECTION */

.order-section {
    padding: 80px 20px;
}

.order-container {
    max-width: 1200px;

    margin: auto;

    display: grid;

    grid-template-columns:
        minmax(0, 1.7fr)
        minmax(300px, .8fr);

    gap: 35px;

    align-items: start;
}


/* HEADING */

.section-heading {
    margin-bottom: 28px;
}

.section-heading span {
    color: var(--brand-accent);

    font-size: 13px;

    font-weight: 800;

    letter-spacing: 2px;
}

.section-heading h2 {
    margin: 7px 0;

    font-size: 32px;

    color: #0f172a;

    font-family: 'Space Grotesk', sans-serif;
}

.section-heading p {
    color: #64748b;

    margin: 0;
}


/* FOOD ITEM */

.food-item {
    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

    padding: 20px;

    margin-bottom: 15px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    transition: .25s;
}

.food-item:hover {
    transform: translateY(-2px);

    box-shadow: 0 10px 30px rgba(15,23,42,.08);
}

.food-info {
    display: flex;

    align-items: center;

    gap: 16px;

    min-width: 0;
}

.food-icon {
    width: 65px;
    height: 65px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #eff6ff;

    border-radius: 16px;

    font-size: 30px;
}

.food-item-image {
    flex: 0 0 76px;
    width: 76px;
    height: 76px;
    border-radius: 14px;
    object-fit: cover;
}

.fulfillment-choice {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin: 0 0 22px;
    padding: 16px;
    border: 1px solid #dbe3ed;
    border-radius: 14px;
}

.fulfillment-choice legend {
    padding: 0 7px;
    color: #26364b;
    font-weight: 700;
}

.fulfillment-choice label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #26364b;
    font-weight: 600;
}

.fulfillment-choice input {
    accent-color: var(--brand-accent);
}

.fulfillment-note {
    flex-basis: 100%;
    color: #64748b;
}

.food-info h3 {
    margin: 0 0 5px;

    font-size: 18px;

    color: #0f172a;
}

.food-info p {
    margin: 0 0 7px;

    color: #64748b;

    font-size: 14px;
}

.food-info strong {
    color: var(--brand-accent);

    font-size: 15px;
}


/* QUANTITY */

.quantity-box {
    display: flex;

    align-items: center;

    gap: 10px;

    flex-shrink: 0;
}

.quantity-btn {
    width: 40px;
    height: 40px;

    border: none;

    border-radius: 10px;

    background: #eff6ff;

    color: var(--brand-accent);

    font-size: 22px;

    font-weight: 700;

    cursor: pointer;

    transition: .2s;
}

.quantity-btn:hover {
    background: var(--brand-accent);

    color: white;
}

.quantity-box span {
    width: 25px;

    text-align: center;

    font-size: 17px;

    font-weight: 800;

    color: #0f172a;
}


/* CUSTOMER DETAILS */

.customer-details {
    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 20px;

    padding: 28px;

    margin-top: 30px;
}

.small-heading {
    margin-bottom: 22px;
}

.small-heading h2 {
    font-size: 25px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;

    margin-bottom: 7px;

    color: #334155;

    font-size: 14px;

    font-weight: 700;
}

.form-group input,
.form-group textarea {
    width: 100%;

    box-sizing: border-box;

    padding: 13px 15px;

    border: 1px solid #cbd5e1;

    border-radius: 11px;

    background: #f8fafc;

    color: #0f172a;

    font-family: inherit;

    font-size: 15px;

    outline: none;

    transition: .2s;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: var(--brand-accent);

    background: white;

    box-shadow:
        0 0 0 3px rgba(32, 169, 212,.1);
}

.form-group textarea {
    resize: vertical;
}

.error {
    display: block;

    margin-top: 5px;

    color: #dc2626;
}


/* BUTTON */

.confirm-order {
    width: 100%;

    border: none;

    border-radius: 13px;

    padding: 16px;

    margin-top: 22px;

    background: var(--brand-accent);

    color: white;

    font-size: 16px;

    font-weight: 800;

    cursor: pointer;

    transition: .25s;
}

.confirm-order:hover {
    background: var(--brand-accent-dark);

    transform: translateY(-2px);

    box-shadow:
        0 12px 25px rgba(32, 169, 212,.25);
}


/* SUMMARY */

.order-summary {
    position: sticky;

    top: 100px;
}

.summary-card {
    background: white;

    border: 1px solid #e2e8f0;

    border-radius: 20px;

    padding: 25px;

    box-shadow:
        0 10px 35px rgba(15,23,42,.06);
}

.summary-header {
    display: flex;

    align-items: center;

    justify-content: space-between;

    padding-bottom: 18px;

    border-bottom: 1px solid #e2e8f0;

    font-size: 20px;

    font-weight: 800;

    color: #0f172a;
}

.cart-icon {
    width: 42px;
    height: 42px;

    border-radius: 12px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #eff6ff;
}


/* SUMMARY ITEMS */

.summary-items {
    padding: 20px 0;
}

.empty-order {
    text-align: center;

    padding: 25px 10px;

    color: #64748b;
}

.empty-order div {
    font-size: 42px;

    margin-bottom: 10px;
}

.empty-order p {
    margin: 0 0 5px;

    font-weight: 700;

    color: #334155;
}

.empty-order small {
    color: #94a3b8;
}

.summary-row {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 10px 0;

    border-bottom: 1px solid #f1f5f9;
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-food-name {
    color: #334155;

    font-size: 14px;

    font-weight: 700;
}

.summary-food-qty {
    color: #64748b;

    font-size: 13px;
}

.summary-food-price {
    color: #0f172a;

    font-size: 14px;

    font-weight: 800;
}


/* TOTAL */

.summary-total {
    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 18px 0;

    border-top: 1px solid #e2e8f0;
}

.summary-total span {
    color: #64748b;

    font-weight: 700;
}

.summary-total strong {
    color: var(--brand-accent);

    font-size: 22px;
}


/* NOTE */

.summary-note {
    padding: 13px;

    border-radius: 12px;

    background: #f8fafc;

    color: #64748b;

    font-size: 12px;

    line-height: 1.5;
}


/* MOBILE */

@media (max-width: 850px) {

    .order-container {
        grid-template-columns: 1fr;
    }

    .order-summary {
        position: static;
    }

}


@media (max-width: 600px) {

    .order-section {
        padding: 50px 15px;
    }

    .food-item {
        align-items: flex-start;

        flex-direction: column;
    }

    .quantity-box {
        align-self: flex-end;
    }

    .customer-details {
        padding: 20px;
    }

    .hero-content h1 {
        font-size: 38px;
    }

}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const foods = {};

    document.querySelectorAll('.food-item[data-food-id]')
        .forEach(function (item) {
            const key = 'food-' + item.dataset.foodId;

            foods[key] = {
                name: item.dataset.foodName,
                price: Number(item.dataset.foodPrice),
                quantity: 0
            };
        });


    function formatMoney(amount) {

        return 'TSh ' +
            amount.toLocaleString('en-TZ');

    }


    function updateOrder() {

        const summaryItems =
            document.getElementById('summaryItems');

        const grandTotal =
            document.getElementById('grandTotal');

        let total = 0;

        let html = '';

        let selected = false;


        Object.keys(foods).forEach(function (key) {

            const food = foods[key];

            const quantity =
                Math.max(0, parseInt(food.quantity) || 0);


            food.quantity = quantity;


            document.getElementById(
                key + '-quantity'
            ).textContent = quantity;


            document.getElementById(
                key + '-input'
            ).value = quantity;


            if (quantity > 0) {

                selected = true;

                const subtotal =
                    food.price * quantity;

                total += subtotal;


                html += `

                    <div class="summary-row">

                        <div>

                            <div class="summary-food-name">
                                ${food.name}
                            </div>

                            <div class="summary-food-qty">
                                Qty: ${quantity}
                            </div>

                        </div>

                        <div class="summary-food-price">
                            ${formatMoney(subtotal)}
                        </div>

                    </div>

                `;

            }

        });


        if (!selected) {

            html = `

                <div class="empty-order">

                    <div>🍽️</div>

                    <p>Your order is empty.</p>

                    <small>
                        Select food from the menu.
                    </small>

                </div>

            `;

        }


        summaryItems.innerHTML = html;

        grandTotal.textContent =
            formatMoney(total);

    }


    document.querySelectorAll('.quantity-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const target =
                    this.dataset.target;

                if (this.classList.contains('plus')) {

                    foods[target].quantity++;

                } else {

                    foods[target].quantity--;

                }

                updateOrder();

            });

        });


    document.getElementById('orderForm')
        .addEventListener('submit', function (event) {

            let hasFood = false;


            Object.keys(foods).forEach(function (key) {

                if (foods[key].quantity > 0) {

                    hasFood = true;

                }

            });


            if (!hasFood) {

                event.preventDefault();

                alert(
                    'Please select at least one food before placing your order.'
                );

            }

        });


    updateOrder();

});

    const fulfillmentInputs = document.querySelectorAll('input[name="fulfillment_type"]');
    const deliveryAddress = document.getElementById('address');

    fulfillmentInputs.forEach(function (input) {
input.addEventListener('change', function () {
    const deliverySelected = this.value === 'delivery';
    deliveryAddress.required = deliverySelected;
    deliveryAddress.placeholder = deliverySelected
        ? 'Enter your delivery address'
        : 'Pickup order — address not required';
});
    });

    const selectedFulfillment = document.querySelector('input[name="fulfillment_type"]:checked');
    if (selectedFulfillment) {
selectedFulfillment.dispatchEvent(new Event('change'));
    }

</script>

@endsection