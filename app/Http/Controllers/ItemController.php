<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Item;
use App\Category;
use App\Unit;
use App\Brand;

class ItemController extends Controller
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
	   $category = Category::select('name','id')->where('is_active', '=', '1' )->get();
	   $unit = Unit::select('name','id')->where('is_active', '=', '1' )->get();
	    $brands = Brand::select('name','id')->where('is_active', '=', '1' )->get();
	   return view('item.create', compact('category','unit','brands'));
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
        $item = Item::create([
			'name' => $request->input('name'),
			'category_id' => $request->input('category'),
			'brand_id' => $request->input('brand'),
			'unit' => $request->input('unit'),
			'hsn_code' => $request->input('hsn_code')
		]);
       
		if($item) {
			return redirect('/items/index')->with('success', 'New item has been created!');
	   }
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$item = Item::where('id', $id)->first();
		$category = Category::select('name','id')->where('is_active', '=', '1' )->get();
		$unit = Unit::select('name','id')->where('is_active', '=', '1' )->get();
		$brands = Brand::select('name','id')->where('is_active', '=', '1' )->get();
        return view('item.edit', compact('item','id','category','unit','brands'));
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
        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->category_id = $request->input('category');
        $item->unit = $request->input('unit');
		$item->brand_id = $request->input('brand');
		$item->hsn_code = $request->input('hsn_code');
        $item->save();

        return redirect('/items/index')->with('success', 'Item has been updated!!');
    }
	
	public function index()
    {
        //$categories = Category::all();
		//$items = DB::table('sm_items')->paginate(15);
       $items = DB::table('sm_items')
                ->leftJoin('sm_categories', 'sm_categories.id', '=', 'sm_items.category_id')
				->leftJoin('sm_units', 'sm_units.id', '=', 'sm_items.unit')
				->leftJoin('sm_brands', 'sm_brands.id', '=', 'sm_items.brand_id')
                ->select('sm_items.*', 'sm_categories.name as category_name','sm_units.name as unit_name','sm_brands.name as brand_name')
				->where('sm_items.is_active', '=', '1')
				->paginate(15);
                
        return view('item.index',compact('items'));
    }
	

	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       // $item = Item::find($id);
        //$item->delete();
		
		 $data = array();
		 $data['is_active'] = 0;
        Item::where('id',$id)
        ->update($data);

        return redirect('/items/index')->with('success', 'Item has been deleted!!');
    }
}
