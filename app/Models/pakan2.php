<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class pakan2 extends Model
{
    protected $connection = 'mongodb';
     protected $collection = 'pakan2';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'putaran','jam2','menit2','created_at','hari'
     ];
}
