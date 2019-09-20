@extends('layouts.app')
@section('title','Category List')
@section('breadcrumb','Category')
@section('content')
<div class="container">
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
    <table class="table table-striped">
        <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td><a href="{{action('CategoryController@edit',$category->id)}}" class="btn btn-primary">Edit</a></td>
               @if($category->is_active == 1)
				   <td><a href="javascript:void(0);" id='{{$category->id}}' class="btn btn-primary deactivate">Deactivate</a></td>
			   @else
				   <td><a href="javascript:void(0);" id='{{$category->id}}' class="btn btn-primary activate">Activate</a></td>
			   @endif
			   <td>
				  <form action="{{action('CategoryController@destroy',$category->id) }}" method="post">
					{{csrf_field()}}
					<input name="_method" type="hidden" value="DELETE">
					<button class="btn btn-danger" type="submit">Delete</button>
				  </form>
				</td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div>
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
			
			jQuery(".deactivate").bind('click',function(){
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
			
			jQuery(".activate").bind('click',function(){
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