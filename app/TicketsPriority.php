<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsPriority extends Model
{
  protected $fillable = ['priority'];

  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
