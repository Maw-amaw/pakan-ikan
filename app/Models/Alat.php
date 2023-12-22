<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Alat extends Eloquent
{
     //
     protected $connection = 'mongodb';
     protected $collection = 'alat';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'alat','ssid','password','status'
     ];
}
