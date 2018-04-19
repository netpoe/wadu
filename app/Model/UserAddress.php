<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city',
        'street',
        'neighborhood',
        'interior_number',
        'references',
        'zip_code'
    ];
}
