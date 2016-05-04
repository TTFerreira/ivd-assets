<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsPriority extends Model
{
  protected $fillable = ['priority'];
  public $timestamps = false;

  public function ticket()
  {
    return $this->hasMany(Ticket::class);
  }
}
