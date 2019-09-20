<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockInItems extends Model
{
    //
	protected $table = 'sm_supply_in_items';
	
	protected $fillable = ['sm_supply_in_id', 'item_id', 'qty', 'price'];
}