@extends('layouts.app')
@section('title','Add Item')
@section('breadcrumb','Add Item')
@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
    <div class="row">
    <form method="post" action="{{url('/item/create')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Item Name:</label>
            <input type="text" class="form-control" name="name"/>
        </div>
		<div class="form-group">
            <label for="name">Parent Category:</label>
			<select name="parent_id" class="form-control">
				<option value="0">No Parent</option>
				@foreach($parentCat as $p)
					<option value="{{ $p->id }}">{{ $p->name }}</option>
				@endforeach
			</select>
        </div>
        <div class="form-group">
            <label for="description">Category Description:</label>
            <textarea cols="5" rows="5" class="form-control" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection