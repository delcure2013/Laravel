<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    //
	protected $table = 'sm_supply_out';
	
	protected $fillable = ['id', 'supply_out_date', 'sm_supply_in_id', 'sm_sup_in_item_id', 'item_id', 'qty', 'employee_id', 'location_id', 'other_name', 'other_mobile', 'remarks', 'ip_address'];
}