<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
  protected $fillable = ['manufacturer_id', 'asset_type_id', 'pcspec_id', 'asset_model', 'part_number'];

  public function manufacturer()
  {
    return $this->belongsTo(Manufacturer::class);
  }

  public function asset_type()
  {
    return $this->belongsTo(AssetType::class);
  }

  public function pcspec()
  {
    return $this->belongsTo(Pcspec::class);
  }

  public function asset()
  {
    return $this->hasMany(Asset::class);
  }

}
