<?php

namespace App;

use App\Modules\Users\Models\UserRoles;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOnline()
    {
        return ($this->last_activity > Carbon::now()->subMinutes(5)) ? true : false;
    }

    public function roles()
    {
        return $this->hasMany(UserRoles::class, 'user_id', 'id');
    }


}
