<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Contract\{
    DictionaryContract,
    DictionaryTrait
};

class AddressCountry extends Model implements DictionaryContract
{
    use DictionaryTrait;

    protected $table = 'address_countries';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    const GUATEMALA = 1;

    const DATA = [
        self::GUATEMALA => [
            'id' => self::GUATEMALA,
            'name' => 'Guatemala'
        ]
    ];
}
