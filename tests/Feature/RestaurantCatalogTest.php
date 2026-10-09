<?php

namespace Tests\Feature;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\UserLoginActivity;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class RestaurantCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_available_food_from_the_database(): void
    {
        Food::create([
            'name' => 'Kessy Special',
            'category' => 'specials',
            'description' => 'Made fresh today.',
            'price' => 8500,
            'is_available' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Kessy Special')
            ->assertSee('Made fresh today.');
    }

    public function test_homepage_uses_a_fallback_when_a_food_image_file_is_missing(): void
    {
        Food::create([
            'name' => 'Classic Burger',
            'category' => 'burgers',
            'price' => 8000,
            'image' => 'burger.jpg',
            'is_available' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('https://images.unsplash.com/photo-1568901346375-23c9450c58cd', false);
    }

    public function test_foods_without_images_get_different_fallbacks_by_food_type(): void
    {
        $burger = Food::create([
            'name' => 'Classic Burger',
            'category' => 'burgers',
            'price' => 8000,
            'is_available' => true,
        ]);

        $pizza = Food::create([
            'name' => 'Cheese Pizza',
            'category' => 'pizza',
            'price' => 9000,
            'is_available' => true,
        ]);

        $this->assertStringContainsString('photo-1568901346375-23c9450c58cd', $burger->image_url);
        $this->assertStringContainsString('photo-1513104890138-7c749659a591', $pizza->image_url);
        $this->assertNotSame($burger->image_url, $pizza->image_url);
    }

    public function test_uji_food_uses_a_porridge_image_when_its_image_is_missing(): void
    {
        $uji = Food::create([
            'name' => 'Uji',
            'category' => 'breakfast',
            'price' => 2000,
            'image' => 'uji.png',
            'is_available' => true,
        ]);

        $this->assertStringContainsString('photo-1555078604-b2379f0e964a', $uji->image_url);
    }

    public function test_menu_search_category_and_price_filters_work_together(): void
    {
        Food::create([
            'name' => 'Chicken Wrap',
            'category' => 'wraps',
            'price' => 7000,
            'is_available' => true,
        ]);

        Food::create([
            'name' => 'Chicken Feast',
            'category' => 'specials',
            'price' => 12000,
            'is_available' => true,
        ]);

        $this->get('/menu?search=Chicken&category=wraps&max_price=9000')
            ->assertOk()
            ->assertSee('Chicken Wrap')
            ->assertDontSee('Chicken Feast');
    }

    public function test_order_page_requires_login_before_customer_selects_meals(): void
    {
        $this->get(route('order'))
            ->assertRedirect(route('login'));
    }

    public function test_registration_page_is_not_cached_with_an_old_csrf_token(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->assertHeader('Pragma', 'no-cache');
    }

    public function test_registration_sends_verification_email_and_blocks_unverified_account_access(): void
    {
        Notification::fake();

        $this->post(route('register.store'), [
            'name' => 'New Customer',
            'email' => 'new-customer@example.com',
            'gender' => 'female',
            'phone' => '+255712345678',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'admin',
        ])->assertRedirect(route('verification.notice'));

        $user = User::where('email', 'new-customer@example.com')->firstOrFail();

        $this->assertAuthenticatedAs($user);
        $this->assertNull($user->email_verified_at);
        $this->assertSame('female', $user->gender);
        $this->assertSame('+255712345678', $user->phone);
        $this->assertSame('customer', $user->role);
        $registrationActivity = $user->loginActivities()->firstOrFail();
        $this->assertSame('registration', $registrationActivity->event_type);
        $this->assertNotNull($registrationActivity->logged_in_at);
        Notification::assertSentTo($user, VerifyEmail::class, function (VerifyEmail $notification) use ($user): bool {
            $mail = $notification->toMail($user);

            return $mail->subject === 'Verify your Kessy Brothers Food account'
                && $mail->view === [
                    'html' => 'emails.verify-email',
                    'text' => 'emails.verify-email-text',
                ];
        });

        $this->get(route('dashboard'))
            ->assertRedirect(route('verification.notice'));

        $this->post(route('verification.send'))
            ->assertRedirect()
            ->assertSessionHas('status', 'verification-link-sent');

        Notification::assertSentToTimes($user, VerifyEmail::class, 2);
    }

    public function test_signed_verification_link_verifies_user_email(): void
    {
        $user = User::factory()->unverified()->create();
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $this->actingAs($user)
            ->get($verificationUrl)
            ->assertRedirect(route('login'))
            ->assertSessionHas('success', 'Your email address has been verified.');

        $this->assertNotNull($user->fresh()->email_verified_at);
        $this->assertGuest();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
        $this->get(route('dashboard'))->assertOk();
    }

    public function test_forgot_password_sends_a_branded_reset_email_and_shows_reset_form(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        $this->from(route('password.request'))
            ->post(route('password.email'), ['email' => $user->email])
            ->assertRedirect(route('password.request'))
            ->assertSessionHas('status', __(\Illuminate\Auth\Passwords\PasswordBroker::RESET_LINK_SENT));

        Notification::assertSentTo($user, ResetPasswordNotification::class, function (ResetPasswordNotification $notification) use ($user): bool {
            $mail = $notification->toMail($user);
            $query = [];
            parse_str((string) parse_url($mail->viewData['resetUrl'], PHP_URL_QUERY), $query);

            return $mail->subject === 'Reset your Kessy Brothers Food password'
                && $mail->view === [
                    'html' => 'emails.reset-password',
                    'text' => 'emails.reset-password-text',
                ]
                && ($query['email'] ?? null) === $user->email;
        });

        $token = Password::broker()->createToken($user);

        $this->get(route('password.reset', ['token' => $token, 'email' => $user->email]))
            ->assertOk()
            ->assertSee('Choose a new password')
            ->assertSee('password_confirmation');
    }

    public function test_valid_password_reset_token_changes_password_and_redirects_to_login(): void
    {
        $user = User::factory()->create();
        $token = Password::broker()->createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-secret-password',
            'password_confirmation' => 'new-secret-password',
        ])
            ->assertRedirect(route('login'))
            ->assertSessionHas('success', __(\Illuminate\Auth\Passwords\PasswordBroker::PASSWORD_RESET));

        $this->assertTrue(Hash::check('new-secret-password', $user->fresh()->password));
        $this->assertDatabaseMissing('password_reset_tokens', ['email' => $user->email]);
    }

    public function test_login_activity_tracks_device_ip_and_explicit_logout_time(): void
    {
        $user = User::factory()->create([
            'email' => 'activity-customer@example.com',
            'password' => 'password',
        ]);

        $this->withServerVariables([
            'REMOTE_ADDR' => '203.0.113.24',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Linux; Android 14; Mobile) AppleWebKit/537.36 Chrome/125.0 Mobile Safari/537.36',
        ])->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $activity = $user->loginActivities()->firstOrFail();
        $this->assertSame('203.0.113.24', $activity->ip_address);
        $this->assertSame('Mobile · Android · Chrome', $activity->device);
        $this->assertNull($activity->logged_out_at);

        $this->post(route('logout'))->assertRedirect('/login');

        $this->assertNotNull($activity->fresh()->logged_out_at);
    }

    public function test_only_admins_can_open_customer_management_and_customer_accounts_are_manageable(): void
    {
        $customer = User::factory()->create([
            'name' => 'Customer Record',
            'email' => 'customer-record@example.com',
        ]);

        $this->actingAs($customer)
            ->get(route('admin.users.index'))
            ->assertForbidden();

        $admin = User::factory()->create([
            'name' => 'Admin Account',
            'email' => 'user-admin@example.com',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.users.index'))
            ->assertOk()
            ->assertSee('customer-record@example.com')
            ->assertDontSee('user-admin@example.com');

        $this->patch(route('admin.users.update', $customer->id), [
            'name' => 'Updated Customer',
            'email' => 'updated-customer@example.com',
            'gender' => 'male',
            'phone' => '+255700111222',
        ])->assertRedirect(route('admin.users.show', $customer->id));

        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'name' => 'Updated Customer',
            'email' => 'updated-customer@example.com',
            'gender' => 'male',
            'phone' => '+255700111222',
        ]);

        Notification::fake();
        $this->post(route('admin.users.password-reset', $customer->id))
            ->assertRedirect();
        Notification::assertSentTo($customer, ResetPasswordNotification::class);

        $activity = UserLoginActivity::create([
            'user_id' => $customer->id,
            'session_hash' => hash('sha256', 'historical-customer-session'),
            'device' => 'Desktop · Windows · Chrome',
            'logged_in_at' => now()->subHour(),
            'last_seen_at' => now()->subHour(),
            'logged_out_at' => now()->subMinutes(50),
        ]);

        $this->delete(route('admin.users.destroy', $customer->id))
            ->assertRedirect(route('admin.users.index'));

        $this->assertSoftDeleted('users', ['id' => $customer->id]);
        $this->assertDatabaseHas('user_login_activities', ['id' => $activity->id]);

        $this->patch(route('admin.users.restore', $customer->id))
            ->assertRedirect(route('admin.users.show', $customer->id));
        $this->assertDatabaseHas('users', ['id' => $customer->id, 'deleted_at' => null]);
    }

    public function test_customer_can_choose_pickup_without_entering_a_delivery_address(): void
    {
        $user = User::factory()->create();
        $food = Food::create([
            'name' => 'Vegetable Pasta',
            'category' => 'pasta',
            'price' => 9000,
            'is_available' => true,
        ]);

        $this->actingAs($user)
            ->post(route('order.store'), [
                'items' => [['food_id' => $food->id, 'quantity' => 1]],
                'phone' => '+255700000000',
                'fulfillment_type' => 'pickup',
            ])
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'fulfillment_type' => 'pickup',
            'address' => null,
            'total_amount' => 9000,
        ]);
    }

    public function test_delivery_orders_require_a_delivery_address(): void
    {
        $user = User::factory()->create();
        $food = Food::create([
            'name' => 'Chicken Rice',
            'category' => 'rice',
            'price' => 8000,
            'is_available' => true,
        ]);

        $this->actingAs($user)
            ->from(route('order'))
            ->post(route('order.store'), [
                'items' => [['food_id' => $food->id, 'quantity' => 1]],
                'phone' => '+255700000000',
                'fulfillment_type' => 'delivery',
            ])
            ->assertSessionHasErrors('address');

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_admin_dashboard_shows_completed_sales_and_popular_foods(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();

        $food = Food::create([
            'name' => 'Grilled Chicken',
            'category' => 'grill',
            'price' => 5000,
            'is_available' => true,
        ]);

        $order = Order::create([
            'user_id' => $admin->id,
            'customer_name' => $admin->name,
            'total_amount' => 10000,
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'food_id' => $food->id,
            'quantity' => 2,
            'price' => 5000,
            'subtotal' => 10000,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Grilled Chicken')
            ->assertSee('2 sold')
            ->assertSee('10,000');
    }
}
