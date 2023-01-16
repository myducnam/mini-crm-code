<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Company extends AbstractModel
{
    use Filterable;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];
}
