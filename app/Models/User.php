<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmailContract
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;
    use MustVerifyEmailTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'phone',
        'password',
    ];

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPassword($token));
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function loginActivities(): HasMany
    {
        return $this->hasMany(UserLoginActivity::class)->latest('logged_in_at');
    }

    public function latestLoginActivity(): HasOne
    {
        return $this->hasOne(UserLoginActivity::class)->latestOfMany('logged_in_at');
    }

    public function firstLoginActivity(): HasOne
    {
        return $this->hasOne(UserLoginActivity::class)->oldestOfMany('logged_in_at');
    }

    public function activeLoginActivities(): HasMany
    {
        return $this->hasMany(UserLoginActivity::class)
            ->whereNull('logged_out_at')
            ->where('last_seen_at', '>=', now()->subMinutes((int) config('session.lifetime')));
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
