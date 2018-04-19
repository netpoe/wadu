<?php

namespace App\Contract;

trait DictionaryTrait
{
    public static function asSelectInputOptions(
        Array $dictionary,
        String $key = 'key',
        String $value = 'value')
    {
        return '';
    }
}
