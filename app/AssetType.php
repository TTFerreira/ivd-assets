<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    protected $fillable = ['type_name', 'abbreviation'];
}
