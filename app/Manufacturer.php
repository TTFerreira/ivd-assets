<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
  protected $fillable = ['name'];
  public $timestamps = false;

  public function assetModel()
  {
    return $this->hasMany(AssetModel::class);
  }
}
