<?php

namespace App\Contract;

interface DictionaryContract
{
    public function asSelectInputOptions(
        String $keyName = 'key',
        String $valueName = 'value');
}
