<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Employe extends AbstractModel
{
    use Filterable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_id'
    ];

    protected $table = 'employees';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
