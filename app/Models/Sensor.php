<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Sensor extends Eloquent
{
     //
     protected $connection = 'mongodb';
     protected $collection = 'sensor';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
        'created_at','temperature','pH'
     ];

}
