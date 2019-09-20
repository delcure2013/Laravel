<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
	protected $table = 'sm_locations';
	
	protected $fillable = ['name','is_active'];
}