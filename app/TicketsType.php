<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsType extends Model
{
  protected $fillable = ['type'];
  public $timestamps = false;

  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
