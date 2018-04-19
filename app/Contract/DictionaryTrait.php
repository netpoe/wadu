<?php

namespace App\Contract;

trait DictionaryTrait
{
    public function asSelectInputOptions(
        String $keyName = 'key',
        String $valueName = 'value')
    {
        $data = $this::DATA;

        if (!isset($data) || empty($data)) {
            throw new \Exception('No constant DATA array was detected');
        }

        $options = [
            [
                'key' => null,
                'value' => __('Select an option'),
            ]
        ];
        array_reduce($data, function($acc, $current) use (&$options, $keyName, $valueName){
            return $options[] = [
                'key' => $current[$keyName],
                'value' => $current[$valueName]
            ];
        });

        return $options;
    }
}
