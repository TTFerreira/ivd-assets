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

  public function asset()
  {
    return $this->hasMany(Asset::class);
  }
}
