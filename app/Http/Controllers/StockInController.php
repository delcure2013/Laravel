<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Supplier;
use App\Item;
use App\StockIn;
use App\StockInItems;

class StockInController extends Controller
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
  
	public function createStockIn()
	{
		//$data = array("Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Pondicherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttaranchal", "Uttar Pradesh", "West Bengal");
		$suppliers = Supplier::select('name','id')->where('is_active', '=', '1' )->get();

		$items = DB::table('sm_items')
			->leftJoin('sm_brands', 'sm_brands.id', '=', 'sm_items.brand_id')
			->select('sm_items.id','sm_items.name','sm_brands.name as brand_name')
			->where('sm_items.is_active', '=', '1')
			->get();
		 
	   return view('stock.createStockIn', compact('suppliers','items'));
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
		//Receipt date conversion start
		        $this->validate($request, [
        'supplier' => 'required|max:10',
        'check_in' => 'required'
        ]);

		$hdnCount=$request->input('hdnCount');

        $stockIn = StockIn::create([
			'supplier_id' => $request->input('supplier'),
			'check_in_date' => Carbon::createFromFormat('d/m/Y', $request->check_in)->format('Y-m-d'),
			'remarks' => $request->input('remarks'),
			'ip_address' => request()->ip()
		]);
		 $lastInsertedId= $stockIn->id;
		 
			for ($i = 1; $i<= (int)$hdnCount; $i++)
			{
				$item = StockInItems::create([
				
						'sm_supply_in_id' => $lastInsertedId,
						'item_id' =>$request->input('item_id'.$i),
						'qty' => $request->input('qty'.$i),
						'price' => $request->input('price'.$i)
					]);
			}
		
	
       
		if($item) {
			return redirect('/stock/index')->with('success', 'New stock has been successfully created!');
	   }
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		//fetch supply in records from database
        $stockin = StockIn::where('id', $id)->first();
		
		//convert check in date to datepicker format 
		$stockin->check_in_date = date("d/m/Y", strtotime($stockin->check_in_date));
		
		//fetch supplier
		$suppliers = Supplier::select('name','id')->where('is_active', '=', '1')->get();
		
		//fetch items
		$items = DB::table('sm_items')
				->leftJoin('sm_brands', 'sm_brands.id', '=', 'sm_items.brand_id')
                ->select('sm_items.id','sm_items.name','sm_brands.name as brand_name')
				->where('sm_items.is_active', '=', '1' )
				 ->get();

		//fetch supply in items
		$supplyin_items = DB::table('sm_supply_in_items')
				->leftJoin('sm_items', 'sm_items.id', '=', 'sm_supply_in_items.item_id')
                ->select('sm_supply_in_items.*','sm_items.name as item_name', 'sm_items.id as item_id')
				->where('sm_supply_in_items.sm_supply_in_id', $id)
				 ->get();
		
        return view('stock.editStockIn', compact('stockin', 'id', 'suppliers', 'items', 'supplyin_items'));
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        		//fetch supply in records from database
        $stockin = StockIn::where('id', $id)->first();
		
		//convert check in date to datepicker format 
		$stockin->check_in_date = date("d/m/Y", strtotime($stockin->check_in_date));
		
		//fetch supplier
		$suppliers = Supplier::select('name','id')->get();
		
		//fetch items
		$items = DB::table('sm_items')
				->leftJoin('sm_brands', 'sm_brands.id', '=', 'sm_items.brand_id')
                ->select('sm_items.id','sm_items.name','sm_brands.name as brand_name')
				 ->get();

		//fetch supply in items
		$supplyin_items = DB::table('sm_supply_in_items')
				->leftJoin('sm_items', 'sm_items.id', '=', 'sm_supply_in_items.item_id')
                ->select('sm_supply_in_items.*','sm_items.name as item_name', 'sm_items.id as item_id')
				->where('sm_supply_in_items.sm_supply_in_id', $id)
				 ->get();
		
        return view('stock.viewStockIn', compact('stockin', 'id', 'suppliers', 'items', 'supplyin_items'));
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
		
		/*$this->validate($request, [
        'supplier' => 'required|max:10',
        'check_in' => 'required'
        ]);*/
		
        $stockIn = StockIn::find($id);
        $stockIn->supplier_id = $request->input('supplier');
		$stockIn->check_in_date = Carbon::createFromFormat('d/m/Y', $request->check_in)->format('Y-m-d');
        $stockIn->remarks = $request->input('remarks');
        $stockIn->ip_address = request()->ip();
		$stockIn->save();
		
	
		$hdnCount=$request->input('hdnCount');

			for ($i = 1; $i<= (int)$hdnCount; $i++)
			{
				$item = StockInItems::create([
				
						'sm_supply_in_id' => $id,
						'item_id' =>$request->input('item_id'.$i),
						'qty' => $request->input('qty'.$i),
						'price' => $request->input('price'.$i)
					]);
			}
		

        return redirect('/stock/index')->with('success', 'Stock In has been updated!!');
    }
	
	public function index()
    {
        //$categories = Category::all();

   
			  $stockIns = DB::table('sm_supply_in')
				->leftJoin('sm_suppliers', 'sm_suppliers.id', '=', 'sm_supply_in.supplier_id')
				->leftJoin('sm_supply_out', 'sm_supply_out.sm_supply_in_id', '=', 'sm_supply_in.id')
                ->select('sm_supply_in.*','sm_suppliers.name as sup_name','sm_supply_out.sm_supply_in_id')
				->distinct()
				 ->paginate(15);
			
		
        return view('stock.indexStockIn',compact('stockIns'));
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
		// delete from supply in table
        //$StockIn = StockIn::find($id);
        //$StockIn->delete();
		
		$data = array();
		$data['is_active'] = 0;
		StockIn::where('id',$id)
		->update($data);
		
		// delete from supply in items table
		$data['is_active'] = 0;
		StockInItems::where('id',$id)
		->update($data);
		
	//DB::table('sm_supply_in_items')->where('sm_supply_in_id', '=', $id)->delete();
	
        return redirect('/stock/index')->with('success', 'Stock In record has been deleted!!');
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	    public function destroyItems($id)
    {

		
	StockInItems::find($id)->delete($id);

    return response()->json([

        'success' => 'Record deleted successfully!'

    ]);
		
       // return redirect('/stock/edit/'.$id)->with('success', 'Stock In item has been deleted!!');
    }
}
