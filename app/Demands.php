<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demands extends Model
{
      protected $table = "demands";
      protected $fillable = [
          'product', 'packaging', 'country', 'pallet', 'boxes','label','lot','ending_day','ending_time', 'certificates','delivery', 'description','fk_user'
      ];
}
