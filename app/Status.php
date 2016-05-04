<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  protected $fillable = ['name'];
  public $timestamps = false;

  public function movement()
  {
    return $this->hasMany(Movement::class);
  }
}
