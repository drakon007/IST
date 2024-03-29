<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
        'login',
        'fio',
        'group_id',
        'token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'login',
        'fio',
        'group_id',
        'token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

}
