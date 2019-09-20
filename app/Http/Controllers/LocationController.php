<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Location;
use App\Unit;

class LocationController extends Controller
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
        $location = Location::create([
			'name' => $request->input('name')
		]);
       
		if($location) {
			return redirect('/location/index')->with('success', 'New location has been created!');
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
        $data['is_active'] = $request->is_active;
		Location::where('id',$request->id)
        ->update($data);
        return redirect('/location/index')->with('success', 'Location has been updated!!');
    }
	
	/**
     * view the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function view($id) {
        $location = Location::find($id);
        return $location;
    }
	
	public function index()
    {
        //$categories = Category::all();
		$locations = DB::table('sm_locations')->paginate(15);
        return view('location.index',compact('locations'));
    }
	

	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::where('id',$id)
        ->update(['is_active' =>0]);

        return redirect('/location/index')->with('success', 'location has been deleted!!');
    }
}
