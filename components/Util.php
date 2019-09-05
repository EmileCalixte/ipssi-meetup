<?php

namespace app\components;

class Util
{
    public static function average(...$numbers): ?float
    {
        if (count($numbers) === 0) {
            return null;
        }
        return array_sum($numbers) / count($numbers);
    }

    public static function rateAverage(...$rateValues): ?float
    {
        return round(self::average(...$rateValues), 1);
    }
}
