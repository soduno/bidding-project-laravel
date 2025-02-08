<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = "comments";
  protected $fillable = [
      'comment', 'fk_user','fk_demand'
  ];
}
