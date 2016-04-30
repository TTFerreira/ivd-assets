<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
  protected $fillable = ['type_name', 'abbreviation'];
  public $timestamps = false;

  public function asset_model()
  {
    return $this->belongsTo(AssetModel::class);
  }
}
