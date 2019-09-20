<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
	protected $table = 'sm_brands';
	
	protected $fillable = ['name', 'description', 'is_active'];
}