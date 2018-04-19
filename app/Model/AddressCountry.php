<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressCountry extends Model
{
    protected $table = 'address_countries';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
