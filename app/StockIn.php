<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    //
	protected $table = 'sm_supply_in';
	
	protected $fillable = ['supplier_id', 'check_in_date', 'remarks', 'ip_address'];
}