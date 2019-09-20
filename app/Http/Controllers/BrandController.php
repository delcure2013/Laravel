<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Brand;

class BrandController extends Controller
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
	  
	   return view('brand.create');
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
        $brand = Brand::create([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
		]);
       
		if($brand) {
			return redirect('/brand/index')->with('success', 'New brand has been created!');
	   }
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where('id', $id)->first();
        return view('brand.edit', compact('brand', 'id'));
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = array();
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
		 $data['is_active'] = $request->is_active;
       Brand::where('id',$request->id)
        ->update($data);

        return redirect('/brand/index')->with('success', 'Brand has been updated!!');
    }
	
	public function index()
    {
        //$categories = Category::all();
		$brands = DB::table('sm_brands')->paginate(15);
        
        return view('brand.index',compact('brands'));
    }
	
	/**
     * view the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function view($id) {
        $brand = Brand::find($id);
        return $brand;
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect('/brand/index')->with('success', 'Brand has been deleted!!');
    }
}
