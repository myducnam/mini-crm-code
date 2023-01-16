<?php

namespace App\Contracts\Api;

use Illuminate\Support\Collection;

interface UserBodyInterface
{
    public function getAchivementRate(array $conditions): ?array;
    
    public function searchBodies(array $conditions): ?Collection;
}
