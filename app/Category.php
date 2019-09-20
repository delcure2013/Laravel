<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $table = 'sm_categories';
	
	protected $fillable = ['name', 'description'];
}