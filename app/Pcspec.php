<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcspec extends Model
{
  protected $fillable = ['cpu', 'ram', 'hdd'];
}
