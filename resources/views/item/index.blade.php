@extends('layouts.app')
@section('title','Item List')
@section('breadcrumb','Items')
@section('content')
@if(\Session::has('success'))
<div class="alert alert-success">
   {{\Session::get('success')}}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@endif
 <a href="{{url('/items/create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a> 
<table class="table table-striped table-bordered" id="item_list" style="font-size:10pt">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <th>Category</th>
		 <th>Brand</th>
         <th>Pack/Unit</th>
         <th>HSN Code</th>
		
         <th style="text-align:center">Action</th>
      </tr>
   </thead>
   <tbody>
      @foreach($items as $item)
      <tr>
         <td width="7%">{{$loop->iteration}}</td>
         <td width="15%">{{$item->name}}</td>
         <td width="15%">{{$item->category_name}}</td>
		  <td width="15%">{{$item->brand_name}}</td>
         <td width="9%">{{$item->unit_name}}</td>
         <td width="10%">{{$item->hsn_code}}</td>
		 
         <td width="20%" style="text-align:center">
            <form action="{{action('ItemController@destroy',$item->id) }}" method="post">
               <!--<a href="{{action('ItemController@view',$item->id)}}" class="btn btn-warning btn-sm" alt="view"  title="view"><i class="fa fa-eye"></i></a>-->
               <a href="{{action('ItemController@edit',$item->id)}}" class="btn btn-primary btn-sm" alt="edit"  title="edit"><i class="fa fa-pencil"></i></a>
               {{csrf_field()}}
               <input name="_method" type="hidden" value="DELETE">
               <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure want to delete??')"  title="delete"><i class="fa fa-trash"></i></button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<!--{{ $items->links() }}-->
@endsection
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
   crossorigin="anonymous"></script>
<script>
   jQuery(document).ready(function(){
   $.ajaxSetup({
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });
   $(document).on('click', "a.deactivate", function() {
   //jQuery(".deactivate").on('click',function(){
   id = $(this).attr("id");
   //alert(id);
   $.ajax({
   type: "POST",
   url: '{{action("SupplierController@change")}}',
   data: {id: id, status: 0},
   success:function(data){
   $( "<div class='alert alert-success'>"+ data.success +"</div>" ).prependTo( ".container" );
   $('.alert-success').show();
   $('#'+id).removeClass('deactivate');
   $('#'+id).addClass('activate');
   $('#'+id).html('Activate');
   }
   });
   });
   $(document).on('click', "a.activate", function() {
   //jQuery(".activate").on('click',function(){
   id = $(this).attr("id");
   $.ajax({
   type: "POST",
   url: '{{action("SupplierController@change")}}',
   data: {id: id, status: 1},
   success:function(data){
   $( "<div class='alert alert-success'>"+ data.success +"</div>" ).prependTo( ".container" );
   $('.alert-success').show();
   $('#'+id).removeClass('activate');
   $('#'+id).addClass('deactivate');
   $('#'+id).html('Deactivate');
   }
   });
   });
         /* e.preventDefault();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
   }); */
   
   });
</script>
<script>
   $(document).ready(function() {
    $('#item_list').DataTable( {
        "paging":   false
    } );
} );
</script>