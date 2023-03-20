<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends \Illuminate\Auth\Notifications\ResetPassword
{

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::trans('auth.reset_password_notification'))
            ->greeting(Lang::trans('app.labels.hello'))
            ->line(Lang::trans('auth.reset_password_message'))
            ->action(Lang::trans('auth.reset_password'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(Lang::trans('auth.reset_password_expire', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::trans('auth.reset_password_no_action_message'))
            ->salutation(Lang::trans('auth.reset_password_salutation'));
    }
}