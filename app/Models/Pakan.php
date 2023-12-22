<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pakan extends Eloquent
{
     //
     protected $connection = 'mongodb';
     protected $collection = 'pakan';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'putaran','created_at','jam1','menit1','hari','jam2','menit2','hari2','jam3','menit3','hari3'
     ];

}
