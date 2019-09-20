<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
	protected $table = 'sm_suppliers';
	
	protected $fillable = ['name', 'description', 'address', 'city', 'district', 'state', 'pincode', 'pan_no', 'gst_no', 'mobile', 'email', 'contact_person_name', 'contact_person_mobile', 'contact_person_email', 'owner_name', 'owner_email', 'owner_mobile', 'remarks'];
}