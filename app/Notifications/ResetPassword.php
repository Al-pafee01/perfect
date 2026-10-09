<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as LaravelResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends LaravelResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        $resetUrl = $this->resetUrl($notifiable);
        $viewData = [
            'user' => $notifiable,
            'resetUrl' => $resetUrl,
            'expiresIn' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
        ];

        return (new MailMessage)
            ->subject('Reset your Kessy Brothers Food password')
            ->view('emails.reset-password', $viewData)
            ->text('emails.reset-password-text', $viewData);
    }
}
