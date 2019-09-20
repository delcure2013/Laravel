<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
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
	   $parentCat = Category::where('parent_id',0)->get();
	   return view('category.create',compact('parentCat'));
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
        $category = Category::create([
			'name' => $request->input('name'),
			'parent_id' => $request->input('parent_id'),
			'description' => $request->input('description'),
		]);
       
		if($category) {
			return redirect('/category/index')->with('success', 'New category has been created!');
	   }
    }
	
	 /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
		$parentCat = Category::where('parent_id',0)->get();
        return view('category.edit', compact('category', 'id','parentCat'));
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
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->description = $request->input('description');
        $category->save();

        return redirect('/category/index')->with('success', 'Category has been updated!!');
    }
	
	public function index()
    {
        //$categories = Category::all();
		$categories = DB::table('sm_categories')->where('is_active', '=', 1)->paginate(15);
        
        return view('category.index',compact('categories'));
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
		 $isParent = Category::where('parent_id', $id)
								->where('is_active', 1)
								->get();
		//print_r($isParent);
		 if($isParent === null) {
			 return response()->json(['fail'=>'You can not deactivate parent Category untill child categories are active.']);
		 } else {
			$category = Category::find($id);
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
       /* $category = Category::find($id);
        $category->delete();*/
		
		 $data = array();
		 $data['is_active'] = 0;
        Category::where('id',$id)
        ->update($data);

        return redirect('/category/index')->with('success', 'Category has been deleted!!');
    }
}
