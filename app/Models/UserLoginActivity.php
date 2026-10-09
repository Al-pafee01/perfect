<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class UserLoginActivity extends Model
{
    protected $fillable = [
        'user_id',
        'event_type',
        'session_hash',
        'ip_address',
        'device',
        'logged_in_at',
        'last_seen_at',
        'logged_out_at',
    ];

    protected function casts(): array
    {
        return [
            'logged_in_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'logged_out_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function closeCurrentSession(Request $request, User $user): void
    {
        if (! $request->hasSession()) {
            return;
        }

        $trackingKey = $request->session()->get('_user_activity_tracking_key');

        if (! is_string($trackingKey) || $trackingKey === '') {
            return;
        }

        self::query()
            ->where('user_id', $user->id)
            ->where('session_hash', hash('sha256', $trackingKey))
            ->whereNull('logged_out_at')
            ->update(['logged_out_at' => now()]);
    }

    public static function describeDevice(?string $userAgent): string
    {
        $agent = strtolower($userAgent ?? '');

        $type = match (true) {
            str_contains($agent, 'ipad'), str_contains($agent, 'tablet') => 'Tablet',
            str_contains($agent, 'mobile'), str_contains($agent, 'iphone'), str_contains($agent, 'android') => 'Mobile',
            default => 'Desktop',
        };

        $platform = match (true) {
            str_contains($agent, 'windows') => 'Windows',
            str_contains($agent, 'android') => 'Android',
            str_contains($agent, 'iphone'), str_contains($agent, 'ipad'), str_contains($agent, 'ios') => 'iOS',
            str_contains($agent, 'mac os'), str_contains($agent, 'macintosh') => 'macOS',
            str_contains($agent, 'linux') => 'Linux',
            default => 'Unknown platform',
        };

        $browser = match (true) {
            str_contains($agent, 'edg/') => 'Edge',
            str_contains($agent, 'opr/'), str_contains($agent, 'opera') => 'Opera',
            str_contains($agent, 'firefox/') => 'Firefox',
            str_contains($agent, 'chrome/') => 'Chrome',
            str_contains($agent, 'safari/') => 'Safari',
            default => 'Unknown browser',
        };

        return "{$type} · {$platform} · {$browser}";
    }
}
