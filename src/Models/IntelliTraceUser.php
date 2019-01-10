<?php namespace Insanetlabs\IntelliTrace\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Insanetlabs\IntelliTrace\Notifications\ResetPasswordNotification;

class IntelliTraceUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'intellitrace_users';

    protected $fillable = ['name', 'email', 'password'];


    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
?>