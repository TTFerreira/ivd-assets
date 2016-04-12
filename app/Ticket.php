<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  protected $fillable = ['user_id', 'location_id', 'ticket_status_id', 'ticket_type_id', 'ticket_priority_id', 'subject', 'description'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function location()
  {
    return $this->belongsTo(Location::class);
  }

  public function ticket_status()
  {
    return $this->belongsTo(TicketsStatus::class);
  }

  public function ticket_priority()
  {
    return $this->belongsTo(TicketsPriority::class);
  }
  public function ticket_type()
  {
    return $this->belongsTo(TicketsType::class);
  }
}
