<?php

namespace App\Traits;

trait CalcTrait
{
    public static function getAchivementRate(?float $weight, ?float $bodyFat): string
    {
        if(! empty($bodyFat)) {
            $rate = rate_format(($weight / $bodyFat));
        } else {
            $rate = '0';
        }

        return $rate;
    }

}
