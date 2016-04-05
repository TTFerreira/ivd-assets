<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
  protected $fillable = ['division_id', 'year', 'total'];

  public function division()
  {
    return $this->belongsTo(Division::class);
  }
}
