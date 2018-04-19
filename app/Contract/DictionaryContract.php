<?php

namespace App\Contract;

interface DictionaryContract
{
    public static function asSelectInputOptions(
        Array $dictionary,
        String $key = 'key',
        String $value = 'value');
}
