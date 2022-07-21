<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Designation;
class Employee extends Model
{
   protected $fillable =['status'];

   public function designation()
   {
     return  $this->belongsTo('App\Designation');
   }
}
