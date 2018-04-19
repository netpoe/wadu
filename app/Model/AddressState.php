<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\{
    Address\AddressCountryAdapter as AddressCountry
};

use App\Contract\{
    DictionaryContract,
    DictionaryTrait
};

class AddressState extends Model implements DictionaryContract
{
    use DictionaryTrait;

    protected $table = 'address_states';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'country_id',
    ];

    const DATA = [
        AddressCountry::GUATEMALA => [
            'id' => 1,
            'name' => 'Guatemala City',
            'country_id' => AddressCountry::GUATEMALA,
        ]
    ];
}
