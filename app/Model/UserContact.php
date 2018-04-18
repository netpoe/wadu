<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\User\UserAdapter as User;
use App\Util\StringUtil;

class UserContact extends Model
{
    protected $table = 'user_contact';

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = StringUtil::cleanPhone($value);
    }
}
