<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsType extends Model
{
  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
