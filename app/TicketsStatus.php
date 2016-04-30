<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsStatus extends Model
{
  protected $fillable = ['status'];
  public $timestamps = false;

  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
