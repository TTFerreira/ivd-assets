<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $fillable = ['invoice_number', 'order_number', 'supplier_id', 'division_id', 'invoiced_date', 'total'];

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }

  public function division()
  {
    return $this->belongsTo(Division::class);
  }

  public function asset()
  {
    return $this->hasMany(Asset::class);
  }
}
