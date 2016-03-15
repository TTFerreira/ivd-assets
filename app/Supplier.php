<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $fillable = ['name'];

  public function invoice()
  {
    return $this->hasMany(Invoice::class);
  }
}
