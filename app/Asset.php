<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  protected $fillable = ['serial_number', 'model_id', 'division_id', 'supplier_id', 'purchase_date', 'warranty_months', 'warranty_type'];

  public function model()
  {
    return $this->belongsTo(AssetModel::class);
  }

  public function division()
  {
    return $this->belongsTo(Division::class);
  }
}
