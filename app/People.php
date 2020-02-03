<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    protected $fillable = [
        'names',
        'email',
        'phone',
        'country',
        'city',
        'province',
        'address',
        'type_people',
        'created_at',
    ];

    public $timestamps = false;
}
