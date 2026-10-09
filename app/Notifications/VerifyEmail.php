<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as LaravelVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends LaravelVerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        $viewData = [
            'user' => $notifiable,
            'verificationUrl' => $verificationUrl,
        ];

        return (new MailMessage)
            ->subject('Verify your Kessy Brothers Food account')
            ->view('emails.verify-email', $viewData)
            ->text('emails.verify-email-text', $viewData);
    }
}
