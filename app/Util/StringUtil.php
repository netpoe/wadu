<?php

namespace App\Util;

class StringUtil
{
    const RANDOM_STRING_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function capitalize($value)
    {
        $val = strtolower($value);

        $val = ucwords($val);

        return ucfirst($val);
    }

    public static function cleanPhone($value)
    {
        return preg_replace('/\D+/', '', $value);
    }

    static function normalizeNames(String $value): string
    {
        $value = strtolower($value);

        return ucwords($value);
    }

    static function getRandomString(Int $length = 12): string
    {
        $factory = new \RandomLib\Factory;

        $generator = $factory->getLowStrengthGenerator();

        $randomString = $generator->generateString($length, self::RANDOM_STRING_CHARS);

        return $randomString;
    }
}
