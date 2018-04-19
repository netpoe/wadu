<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressState extends Model
{
    protected $table = 'address_states';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'country_id',
    ];
}
