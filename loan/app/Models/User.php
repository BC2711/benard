<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\EmailDeliveryService;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'pending_email',
        'pending_email_token',
        'username',
        'address',
        'date_of_birth',
        'gender',
        'role',
        'status',
        'profile_picture',
        'password',
        'locked_at',
        'attempts',
    ];

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
            'date_of_birth' => 'date',
            'password' => 'hashed',
            'two_factor_expires_at' => 'datetime',
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $resetUrl = route('management.password.reset', [
            'token' => $token,
            'email' => $this->email,
        ]);

        app(EmailDeliveryService::class)->queue('auth.password_reset', $this->email, [
            'first_name' => $this->first_name,
            'action_url' => $resetUrl,
            'action_text' => 'Reset password',
        ]);
    }
}
