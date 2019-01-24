<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get a list of budgets for the user
     * 
     */
    public function budgets()
    { 
        return $this->hasMany('App\Budget');
    }

    /**
     * Get a list of accounts for the user
     * 
     */
    public function accounts()
    {
        return $this->hasMany('App\Account');
    }
}
