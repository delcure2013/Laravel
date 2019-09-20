@extends('layouts.app')
@section('title','Stock In List')
@section('breadcrumb','List of Stock In')
@section('content')

	@if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
	   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{\Session::get('success')}}
        </div>
    @endif
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible">
	 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div><br />
	@endif
	<a href="{{url('/stock/createStockIn')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add New Stock</a> 
    <table class="table table-striped table-bordered" id="categories_list" style="font-size:10pt">
        <thead>
            <tr>
			<th>Sr. No.</th>
              <th>Supplier Name</th>
              <th>Check In Date</th>
			  <th>Remarks</th>
              <th style="text-align:center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockIns as $stockIn)
            <tr>
			<td width="10%">{{$loop->iteration}}</td>
                <td width="20%">{{$stockIn->sup_name}}</td>
                <td width="20%">{{$stockIn->check_in_date = date("d/m/Y", strtotime($stockIn->check_in_date))}}</td>
				 <td width="30%">{{$stockIn->remarks}}</td>
                <td width="20%" style="text-align:center">
				<form action="{{action('StockInController@destroy',$stockIn->id) }}" method="post">
				
				<a href="{{action('StockInController@view',$stockIn->id)}}" class="btn btn-warning btn-sm" alt="view"  title="view"><i class="fa fa-eye"></i></a>
@if(($stockIn->sm_supply_in_id)=="")
				<a href="{{action('StockInController@edit',$stockIn->id)}}" class="btn btn-primary btn-sm" alt="edit"  title="edit"><i class="fa fa-pencil"></i></a>				
			@endif
					{{csrf_field()}}
					<input name="_method" type="hidden" value="DELETE">
					<button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure want to delete??')"  title="delete"><i class="fa fa-trash"></i></button>
				  </form>
				</td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{ $stockIns->links() }}
@endsection
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
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
					url: '{{action("CategoryController@change")}}',
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
					url: '{{action("CategoryController@change")}}',
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
    $('#categories_list').DataTable( {
        "paging":   false
    } );
} );
</script>