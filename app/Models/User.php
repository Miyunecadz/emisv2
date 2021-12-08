<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'role',
        'password',
    ];

    private static $roles = [
        'admin' => 'Admin',
        'incharge' => 'In-charge Personnel'
    ];

    public static $ADMIN = 'admin';
    public static $HRMO = 'hrmo';
    public static $INCHARGE = 'incharge';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private static $validRoles = [
        'admin',
        'hrmo',
        'incharge'
    ];

    public static function isValidRole($role)
    {
        return in_array($role, self::$validRoles);
    }


    public function prettyRole()
    {
        return self::$roles[$this->role];
    }

    public function fullName()
    {
        $firstname = Str::title($this->firstname);
        $lastname = Str::title($this->lastname);
        return "{$firstname} {$lastname}";
    }
}
