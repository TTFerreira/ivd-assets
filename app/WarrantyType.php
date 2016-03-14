<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarrantyType extends Model
{
  protected $fillable = ['name'];

  public function asset()
  {
    return $this->hasMany(Asset::class);
  }
}
