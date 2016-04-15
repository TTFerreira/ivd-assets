<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsEntry extends Model
{
  public function ticket()
  {
    return $this->hasOne(Ticket::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
