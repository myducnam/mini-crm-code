<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class MealType extends Enum implements LocalizedEnum
{
    public const MORNING = 'morning';

    public const LUNCH = 'lunch';
    
    public const DINNER = 'dinner';
    
    public const SNACK = 'snack';
}
