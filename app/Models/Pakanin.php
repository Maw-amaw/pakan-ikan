<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pakanin extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'pakanin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'suhu','waktu','created_at','temperature','pH'
    ];


}
