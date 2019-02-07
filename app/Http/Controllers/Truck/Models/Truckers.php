<?php

namespace App\Http\Controllers\Truck\Models;
use Illuminate\Database\Eloquent\Model;


class Truckers extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'truckers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'age',
        'sex',
        'trucks_code',
        'cnh',
        'is_own',
        'is_loaded',
        'number',
        'street',
        'neighborhood',
        'city',
        'state',
        'country',
        'lat',
        'lng'
    ];

}
