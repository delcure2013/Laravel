<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Supplier;

class SupplierController extends Controller
{
    //
	/**
	  * Show the form for creating a new resource.
	  *
	  * @return \Illuminate\Http\Response
	  */
	public function __construct()
	{
		$this->middleware('auth');
	}
  
	public function create()
	{
		$data = array("Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Pondicherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttaranchal", "Uttar Pradesh", "West Bengal");
	 
	   return view('supplier.create', compact('data'));
	}
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//print_r($request->input()); exit;
        $supplier = Supplier::create([
			'name' => $request->input('name'),
			'address' => $request->input('address'),
			'city' => $request->input('city'),
			'district' => $request->input('district'),
			'state' => $request->input('state'),
			'pincode' => $request->input('pincode'),
			'pan_no' => $request->input('sup_pan_no'),
			'gst_no' => $request->input('gst_no'),
			'mobile' => $request->input('sup_mobile'),
			'email' => $request->input('sup_email'),
			'contact_person_name' => $request->input('contactperson_name'),
			'contact_person_mobile' => $request->input('contactperson_mobile'),
			'contact_person_email' => $request->input('contactperson_email'),
			'owner_name' => $request->input('owner_name'),
			'owner_mobile' => $request->input('owner_mobile'),
			'owner_email' => $request->input('owner_email'),
			'remarks' => $request->input('remarks')
		]);
       
		if($supplier) {
			return redirect('/supplier/index')->with('success', 'New supplier has been created!');
	   }
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::where('id', $id)->first();
		$data = array("Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Pondicherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttaranchal", "Uttar Pradesh", "West Bengal");
        return view('supplier.edit', compact('supplier', 'id', 'data'));
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $supplier = Supplier::where('id', $id)->first();
		
        return view('supplier.view', compact('supplier', 'id'));
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$category = new Category();
		//print_r($request->input()); exit;
        $supplier = Supplier::find($id);
        $supplier->name = $request->input('name');
        $supplier->address = $request->input('address');
        $supplier->city = $request->input('city');
		$supplier->district = $request->input('district');
		$supplier->state = $request->input('state');
		$supplier->pincode = $request->input('pincode');
		$supplier->pan_no = $request->input('sup_pan_no');
		$supplier->gst_no = $request->input('gst_no');
		$supplier->mobile = $request->input('sup_mobile');
		$supplier->email = $request->input('sup_email');
		$supplier->contact_person_name = $request->input('contactperson_name');
		$supplier->contact_person_mobile = $request->input('contactperson_mobile');
		$supplier->contact_person_email = $request->input('contactperson_email');
		$supplier->owner_name = $request->input('owner_name');
		$supplier->owner_mobile = $request->input('owner_mobile');
		$supplier->owner_email = $request->input('owner_email');
		$supplier->remarks = $request->input('remarks');
		$supplier->save();

        return redirect('/supplier/index')->with('success', 'Supplier has been updated!!');
    }
	
	public function index()
    {
        //$categories = Category::all();
		$suppliers = DB::table('sm_suppliers')->where('is_active', '=', 1)->paginate(15);
        
        return view('supplier.index',compact('suppliers'));
    }
	
	/**
     * Update the status
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function change(Request $request) {
		 //print_r($_POST); exit;
		 $id = $request->input('id');
		 $status = $request->input('status');
		 //Check if it has sub categories.
		 $isParent = Supplier::where('parent_id', $id)
								->where('is_active', 1)
								->get();
		//print_r($isParent);
		 if($isParent === null) {
			 return response()->json(['fail'=>'You can not deactivate parent Category untill child categories are active.']);
		 } else {
			$category = Supplier::find($id);
			$category->is_active = $status;
			$category->save();
			return response()->json(['success'=>'Status is successfully changed']);
		 }
	 }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       // $supplier = Supplier::find($id);
        //$supplier->delete();
		
		 $data = array();
		 $data['is_active'] = 0;
        Supplier::where('id',$id)
        ->update($data);

        return redirect('/supplier/index')->with('success', 'Supplier has been deleted!!');
    }
}
