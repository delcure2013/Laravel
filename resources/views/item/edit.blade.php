@extends('layouts.app')
@section('title','Edit Items')
@section('breadcrumb','Edit Items')
@section('content')
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
<form method="post" action="{{action('ItemController@update', $id)}}" >
   <div class="form-group">
      <input type="hidden" value="{{csrf_token()}}" name="_token" />
      <label for="name">Item Name:</label>
      <input type="text" class="form-control" name="name" value='{{$item->name}}' required />
   </div>
   <div class="row">
   <div class="col-md-6">
   <div class="form-group">
      <label for="category">Category:</label>
      <select name="category" class="form-control select2" required>
         <option value="">Select Category</option>
         @foreach($category as $categories)
         <option value="{{ $categories->id}}" {{ ( $categories->id == $item->category_id) ? 'selected' : '' }}>{{ $categories->name}}</option>
         @endforeach
      </select>
   </div>
   </div>
     <div class="col-md-6">
   <div class="form-group">  
    <br />
      <a href="{{url('/category/create')}}" class="btn btn-success btn-sm" style="margin-top:5px"><i class="fa fa-plus"></i> Add Category</a>
      
   </div>
   </div>
   </div>
   <div class="row">
    <div class="col-md-6">
   <div class="form-group">
      <label for="description">Brand:</label>
      <select name="brand" class="form-control select2" required>
         <option value="">Select Brand</option>
         @foreach($brands as $brand)
         <option value="{{ $brand->id}}" {{ ( $brand->id == $item->brand_id) ? 'selected' : '' }}>{{ $brand->name}}</option>
         @endforeach
      </select>
   </div>
   </div>
   <div class="col-md-6">
   <div class="form-group">
      <label for="description">Pack/Unit:</label>
      <select name="unit" class="form-control select2" required>
         <option value="">Select Pack/Unit</option>
         @foreach($unit as $units)
         <option value="{{ $units->id}}" {{ ( $units->id == $item->unit) ? 'selected' : '' }}>{{ $units->name}}</option>
         @endforeach
      </select>
   </div>
   </div>
   </div>
   <div class="form-group">
      <label for="hsn_code">HSN Code:</label>
      <input type="text" class="form-control" name="hsn_code" value="{{$item->hsn_code}}" placeholder="Enter HSN Code"/>
   </div>
   <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection