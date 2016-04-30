<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['building', 'office', 'location_name'];
    public $timestamps = false;

    public function movement()
    {
      return $this->hasMany(Movement::class);
    }

    public function ticket()
    {
      return $this->hasMany(Ticket::class);
    }
}
