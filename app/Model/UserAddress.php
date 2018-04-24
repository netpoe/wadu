<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\{
    Address\AddressCountryAdapter as AddressCountry,
    Address\AddressStateAdapter as AddressState
};

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

    protected $appends = [
        'to_string',
    ];

    public function country()
    {
        return $this->belongsTo(AddressCountry::class, 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(AddressState::class, 'state_id', 'id');
    }

    public function getInteriorNumberAttribute($value)
    {
        return "int $value";
    }

    public function getToStringAttribute()
    {
        return "{$this->street}, {$this->interior_number}. {$this->city}, {$this->state->name} - {$this->country->name}";
    }
}
