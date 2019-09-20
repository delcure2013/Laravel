@extends('layouts.app')
@section('title','Add Category')
@section('breadcrumb','Add Category')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif

    <form method="post" action="{{action('CategoryController@update', $id)}}" >
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Category Name:</label>
            <input type="text" class="form-control" name="name" value='{{$category->name}}' placeholder="Enter category name" autocomplete="off"/>
        </div>
		<div class="form-group">
            <label for="name">Parent Category:</label>
			<select name="parent_id" class="form-control select2">
				<option value="0">No Parent</option>
				@foreach($parentCat as $p)
					<option value="{{ $p->id }}" {{ ( $p->id == $category->parent_id) ? 'selected' : '' }}> {{ $p->name }}</option>
				@endforeach
			</select>
        </div>
        <div class="form-group">
            <label for="description">Category Description:</label>
            <textarea cols="5" rows="5" class="form-control" name="description" placeholder="Enter category description" autocomplete="off">{{$category->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
   
@endsection