<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcspec extends Model
{
  protected $fillable = ['cpu', 'ram', 'hdd'];
  public $timestamps = false;

  public function assetModels()
  {
    return $this->belongsTo(AssetModel::class);
  }
}
