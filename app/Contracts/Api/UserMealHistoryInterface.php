<?php

namespace App\Contracts\Api;

use Illuminate\Support\Collection;

interface UserMealHistoryInterface
{
    public function getMealHistories(array $conditions): ?Collection;
}
