<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsCannedField extends Model
{
  protected $fillable = ['user_id', 'location_id', 'ticket_status_id', 'ticket_type_id', 'ticket_priority_id', 'subject', 'description'];
}
