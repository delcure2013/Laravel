<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Unit;

class UnitController extends Controller
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
	  
	   return view('unit.create');
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
        $unit = Unit::create([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
		]);
       
		if($unit) {
			return redirect('/unit/index')->with('success', 'New unit has been created!');
	   }
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::where('id', $id)->first();
        return view('unit.edit', compact('unit', 'id'));
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
        $data['name'] = $request->name;
        $data['description'] = $request->description;
		 $data['is_active'] = $request->is_active;
        Unit::where('id',$request->id)
        ->update($data);

        return redirect('/unit/index')->with('success', 'Unit has been updated!!');
    }
	
	public function index()
    {
        //$categories = Category::all();
		$units = DB::table('sm_units')->paginate(10);
        
        return view('unit.index',compact('units'));
    }
	/**
     * view the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function view($id) {
        $unit = Unit::find($id);
        return $unit;
    }

	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return redirect('/unit/index')->with('success', 'Unit has been deleted!!');
    }
}
