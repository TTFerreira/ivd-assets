<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  /**
   * Mass assignable attributes
   * @var array
   */
  protected $fillable = ['serial_number', 'model_id', 'division_id', 'supplier_id', 'purchase_date', 'warranty_months', 'warranty_type', 'invoice_id', 'ip', 'mac'];

  /**
   * An Asset is owned by an AssetModel
   *
   */
  public function model()
  {
    return $this->belongsTo(AssetModel::class);
  }

  public function division()
  {
    return $this->belongsTo(Division::class);
  }

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }

  public function movement()
  {
    return $this->belongsTo(Movement::class);
  }

  public function warranty_type()
  {
    return $this->belongsTo(WarrantyType::class);
  }

  public function invoice()
  {
    return $this->belongsTo(Invoice::class);
  }
}
