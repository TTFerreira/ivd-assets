<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsPriority extends Model
{
  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
