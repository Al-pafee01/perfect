<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $archived = $request->boolean('archived');
        $search = trim((string) $request->query('search', ''));

        $query = User::query()
            ->where('role', 'customer')
            ->with(['latestLoginActivity', 'firstLoginActivity'])
            ->withCount('activeLoginActivities');

        if ($archived) {
            $query->onlyTrashed();
        }

        if ($search !== '') {
            $query->where(function ($users) use ($search): void {
                $users->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (! $archived && $request->query('status') === 'active') {
            $query->whereHas('activeLoginActivities');
        } elseif (! $archived && $request->query('status') === 'logged_out') {
            $query->whereDoesntHave('activeLoginActivities');
        }

        $users = $query->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        $totalCustomers = User::where('role', 'customer')->count();
        $activeCustomers = User::where('role', 'customer')
            ->whereHas('activeLoginActivities')
            ->count();
        $tanzaniaToday = now('Africa/Dar_es_Salaam');
        $registeredToday = User::where('role', 'customer')
            ->whereBetween('created_at', [
                $tanzaniaToday->copy()->startOfDay()->setTimezone(config('app.timezone')),
                $tanzaniaToday->copy()->endOfDay()->setTimezone(config('app.timezone')),
            ])
            ->count();

        return view('admin.users.index', compact(
            'users',
            'archived',
            'totalCustomers',
            'activeCustomers',
            'registeredToday'
        ));
    }

    public function show(int $userId): View
    {
        $user = User::withTrashed()
            ->where('role', 'customer')
            ->with(['loginActivities' => fn ($activities) => $activities->limit(50)])
            ->findOrFail($userId);

        $activeCutoff = now()->subMinutes((int) config('session.lifetime'));
        $hasActiveSession = $user->activeLoginActivities()->exists();

        return view('admin.users.show', compact('user', 'activeCutoff', 'hasActiveSession'));
    }

    public function edit(int $userId): View
    {
        $user = User::where('role', 'customer')->findOrFail($userId);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, int $userId): RedirectResponse
    {
        $user = User::where('role', 'customer')->findOrFail($userId);
        $oldEmail = $user->email;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'gender' => ['required', Rule::in(['female', 'male', 'prefer_not_to_say'])],
            'phone' => ['required', 'string', 'max:32'],
        ]);

        DB::transaction(function () use ($user, $validated, $oldEmail): void {
            $user->forceFill($validated)->save();

            if ($oldEmail !== $validated['email']) {
                DB::table('password_reset_tokens')->where('email', $oldEmail)->delete();
            }
        });

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'Customer details updated successfully.');
    }

    public function sendPasswordResetLink(int $userId): RedirectResponse
    {
        $user = User::where('role', 'customer')->findOrFail($userId);
        $status = Password::sendResetLink(['email' => $user->email]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'A password reset link has been sent to the customer email.');
        }

        return back()->withErrors([
            'password_reset' => __($status),
        ]);
    }

    public function destroy(int $userId): RedirectResponse
    {
        $user = User::where('role', 'customer')->findOrFail($userId);

        $user->loginActivities()
            ->whereNull('logged_out_at')
            ->update(['logged_out_at' => now()]);

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Customer account deactivated. Their order and login history has been retained.');
    }

    public function restore(int $userId): RedirectResponse
    {
        $user = User::onlyTrashed()
            ->where('role', 'customer')
            ->findOrFail($userId);

        $user->restore();

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'Customer account restored successfully.');
    }
}
