<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsStatus extends Model
{
  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
