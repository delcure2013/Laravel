<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
	protected $table = 'sm_items';
	
	protected $fillable = ['item_code', 'name', 'category_id', 'unit', 'hsn_code'];
}