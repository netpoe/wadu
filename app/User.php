<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Model\{
    Business\BusinessAdapter as Business,
    User\UserContactAdapter as UserContact,
    User\UserRoleAdapter as UserRole,
    User\UserInfoAdapter as UserInfo
};

class User extends Authenticatable
{
    protected $table = 'users';


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'business_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function contact()
    {
        return $this->hasOne(UserContact::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->hasOne(UserRole::class, 'id', 'role_id');
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }
}
