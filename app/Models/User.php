<?php

namespace App\Models;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'name',
        'email',
        'password',
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
            'password' => 'hashed',
        ];
    }
    /**
 * Send the password reset notification.
 *
 * @param  string  $token
 * @return void
 */
public function sendPasswordResetNotification($token)
{
    // This overrides the default Laravel email
    Mail::to($this->email)->send(new ResetPasswordMail($token, $this->email));
}
public function getIsAdminAttribute()
    {
        // Make sure 'role' matches your database column name! 
        // If your column is 'is_admin', change 'role' to 'is_admin'.
        return isset($this->attributes['is_admin']) && $this->attributes['is_admin'] == 1; 
    }
    // Add this relationship
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
