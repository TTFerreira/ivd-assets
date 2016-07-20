<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
  protected $fillable = ['name'];
  public $timestamps = false;

  public function asset_model()
  {
    return $this->belongsTo(AssetModel::class);
  }
}
