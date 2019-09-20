@extends('layouts.app')
@section('title','Category List')
@section('breadcrumb','Category')
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
		</div><br />
	@endif
	<a href="{{url('/category/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a> 
    <table class="table table-striped table-bordered" id="categories_list" style="font-size:10pt">
        <thead>
            <tr>
			<th>Sr. No.</th>
              <th>Name</th>
              <th>Description</th>
              <th style="text-align:center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
			<td width="10%">{{$loop->iteration}}</td>
                <td width="30%">{{$category->name}}</td>
                <td width="30%">{{$category->description}}</td>
				
                <td width="10%" style="text-align:center">
				<form action="{{action('CategoryController@destroy',$category->id) }}" method="post">
				
           <!--    @if($category->is_active == 1)
				   <a href="javascript:void(0);" id='{{$category->id}}' class="btn btn-success btn-sm deactivate" alt="deactivate" title="deactivate"><i class="fa fa-thumbs-o-up"></i></a>
			   @else
				  <a href="javascript:void(0);" id='{{$category->id}}' class="btn btn-success btn-sm activate" alt="activate" title="activate"><i class="fa fa-thumbs-o-down"></i></a>
			   @endif-->
			   <a href="{{action('CategoryController@edit',$category->id)}}" class="btn btn-primary btn-sm" alt="edit"  title="edit"><i class="fa fa-pencil"></i></a>
				  
					{{csrf_field()}}
					<input name="_method" type="hidden" value="DELETE">
					<button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure want to delete??')"  title="delete"><i class="fa fa-trash"></i></button>
				  </form>
				</td>
            </tr>
            @endforeach
        </tbody>
    </table>

{{ $categories->links() }}
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