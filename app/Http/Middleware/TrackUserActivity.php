<?php

namespace App\Http\Middleware;

use App\Models\UserLoginActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackUserActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $user = $request->user();

        if (! $user || ! $request->hasSession() || ! $request->session()->isStarted()) {
            return $response;
        }

        $now = now();
        $trackingKey = $request->session()->get('_user_activity_tracking_key');
        $activity = is_string($trackingKey)
            ? UserLoginActivity::where('session_hash', hash('sha256', $trackingKey))->first()
            : null;
        $sessionExpired = $activity !== null
            && $activity->last_seen_at?->lt($now->copy()->subMinutes((int) config('session.lifetime')));
        $newLogin = $activity === null
            || (int) $activity->user_id !== (int) $user->id
            || $activity->logged_out_at !== null
            || $sessionExpired;

        if ($newLogin) {
            $trackingKey = (string) Str::uuid();
            $request->session()->put('_user_activity_tracking_key', $trackingKey);
            $activity = new UserLoginActivity;
            $activity->fill([
                'user_id' => $user->id,
                'event_type' => $request->routeIs('register.store') ? 'registration' : 'login',
                'session_hash' => hash('sha256', $trackingKey),
                'ip_address' => $request->ip(),
                'device' => UserLoginActivity::describeDevice($request->userAgent()),
                'logged_in_at' => $now,
                'logged_out_at' => null,
            ]);
        }

        $activity->last_seen_at = $now;
        $activity->save();

        return $response;
    }
}
