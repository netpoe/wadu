<?php

namespace App\Model\Address;

use App\Model\AddressState;

class AddressStateAdapter extends AddressState
{
    public function asJsonByCountryId()
    {
        $data = [];

        array_reduce($this->all()->toArray(), function($acc, $current) use (&$data) {
            return $data[$current['country_id']][] = $current;
        });

        return json_encode($data);
    }
}
