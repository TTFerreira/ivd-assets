<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
  protected $fillable = ['type_name', 'abbreviation'];

  public function assetModels()
  {
    return $this->belongsTo(AssetModel::class);
  }
}
