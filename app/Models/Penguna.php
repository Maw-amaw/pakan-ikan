<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Penguna extends Eloquent
{
     //
     protected $connection = 'mongodb';
     protected $collection = 'login';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'username','password','role','alat'
     ];
}
