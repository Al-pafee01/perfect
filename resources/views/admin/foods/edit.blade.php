@extends('layouts.app')

@section('content')

<style>

    .edit-food-page {
        min-height: 100vh;
        background: #f8fafc;
        padding: 120px 20px 80px;
    }

    .edit-food-container {
        max-width: 850px;
        margin: auto;
    }

    .edit-food-header {
        margin-bottom: 30px;
    }

    .edit-food-header h1 {
        margin: 0;
        color: #0f172a;
        font-size: 2.3rem;
        font-weight: 800;
    }

    .edit-food-header p {
        margin-top: 8px;
        color: #64748b;
    }

    .food-form-card {
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, .08);
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #0f172a;
        font-weight: 700;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        box-sizing: border-box;
        outline: none;
        transition: .3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-help {
        margin-top: 6px;
        color: #64748b;
        font-size: .85rem;
    }

    .error-message {
        margin-top: 6px;
        color: #dc2626;
        font-size: .85rem;
        font-weight: 600;
    }

    .availability-box {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 10px;
    }

    .availability-box input {
        width: 18px;
        height: 18px;
        accent-color: #2563eb;
    }

    .availability-box label {
        margin: 0;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
    }

    .back-btn,
    .update-btn {
        display: inline-block;
        border: none;
        text-decoration: none;
        padding: 13px 22px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        font-size: .95rem;
        transition: .3s;
    }

    .back-btn {
        background: #f1f5f9;
        color: #334155;
    }

    .back-btn:hover {
        background: #e2e8f0;
    }

    .update-btn {
        background: #2563eb;
        color: white;
    }

    .update-btn:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
    }

    @media (max-width: 600px) {

        .edit-food-page {
            padding: 100px 15px 60px;
        }

        .food-form-card {
            padding: 22px;
        }

        .edit-food-header h1 {
            font-size: 1.8rem;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .back-btn,
        .update-btn {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }
    }

</style>


<div class="edit-food-page">

    <div class="edit-food-container">

        <!-- HEADER -->

        <div class="edit-food-header">

            <h1>
                Edit Food
            </h1>

            <p>
                Update the information for
                <strong>{{ $food->name }}</strong>.
            </p>

        </div>


        <!-- FORM -->

        <div class="food-form-card">

            <form
                action="{{ route('foods.update', $food) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <!-- FOOD NAME -->

                <div class="form-group">

                    <label for="name">
                        Food Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $food->name) }}"
                        required
                    >

                    @error('name')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- CATEGORY -->

                <div class="form-group">

                    <label for="category">
                        Category
                    </label>

                    <select
                        id="category"
                        name="category"
                        required
                    >

                        <option value="">
                            Select Category
                        </option>

                        <option
                            value="burgers"
                            {{ old('category', $food->category) == 'burgers' ? 'selected' : '' }}
                        >
                            Burgers
                        </option>

                        <option
                            value="pizza"
                            {{ old('category', $food->category) == 'pizza' ? 'selected' : '' }}
                        >
                            Pizza
                        </option>

                        <option
                            value="pasta"
                            {{ old('category', $food->category) == 'pasta' ? 'selected' : '' }}
                        >
                            Pasta
                        </option>

                        <option
                            value="grill"
                            {{ old('category', $food->category) == 'grill' ? 'selected' : '' }}
                        >
                            Grill
                        </option>

                        <option
                            value="drinks"
                            {{ old('category', $food->category) == 'drinks' ? 'selected' : '' }}
                        >
                            Drinks
                        </option>

                    </select>

                    @error('category')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- DESCRIPTION -->

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Describe this food..."
                    >{{ old('description', $food->description) }}</textarea>

                    @error('description')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- PRICE -->

                <div class="form-group">

                    <label for="price">
                        Price (TSh)
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $food->price) }}"
                        min="0"
                        step="0.01"
                        required
                    >

                    @error('price')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- IMAGE -->

                <div class="form-group">

                    <label for="image">
                        Image Name
                    </label>

                    <input
                        type="text"
                        id="image"
                        name="image"
                        value="{{ old('image', $food->image) }}"
                        placeholder="e.g. burger.jpg"
                    >

                    <div class="form-help">
                        Real image upload will be connected later.
                    </div>

                    @error('image')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- AVAILABILITY -->

                <div class="form-group">

                    <div class="availability-box">

                        <input
                            type="checkbox"
                            id="is_available"
                            name="is_available"
                            value="1"
                            {{ old('is_available', $food->is_available) ? 'checked' : '' }}
                        >

                        <label for="is_available">
                            This food is currently available
                        </label>

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="form-actions">

                    <a
                        href="{{ route('foods.index') }}"
                        class="back-btn"
                    >
                        ← Back to Foods
                    </a>


                    <button
                        type="submit"
                        class="update-btn"
                    >
                        ✓ Update Food
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection