<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User\UserAdapter as User;

class UserInfo extends Model
{
    protected $table = 'user_info';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
    ];

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute()
    {
        if (!$this->attributes['first_name'] && !$this->attributes['last_name']) {
            return User::find($this->attributes['user_id'])->email;
        }

        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
}
