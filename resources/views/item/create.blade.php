@extends('layouts.app')
@section('title','Add Item')
@section('breadcrumb','Add Item')
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
<form method="post" action="{{url('/items/create')}}">
   <div class="form-group">
      <input type="hidden" value="{{csrf_token()}}" name="_token" />
      <label for="name">Item Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter Item Name" required />
   </div>
   <div class="row">
     <div class="col-md-6">
   <div class="form-group">
      <label for="category">Category:</label>
      <select name="category" class="form-control select2" required >
         <option>Select Category</option>
         @foreach($category as $categories)
         <option value="{{ $categories->id}}">{{ $categories->name}}</option>
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
         <option>Select Brand</option>
         @foreach($brands as $brand)
         <option value="{{ $brand->id}}">{{ $brand->name}}</option>
         @endforeach
      </select>
   </div>
   </div>
   <div class="col-md-6">
   <div class="form-group">
      <label for="description">Pack/Unit:</label>
      <select name="unit" class="form-control select2" required>
         <option>Select Pack/Unit</option>
         @foreach($unit as $units)
         <option value="{{ $units->id}}">{{ $units->name}}</option>
         @endforeach
      </select>
   </div>
   </div>
   </div>
    <div class="row">
   <div class="col-md-12">
   <div class="form-group">
      <label for="hsn_code">HSN Code:</label>
      <input type="text" class="form-control" name="hsn_code" placeholder="Enter HSN Code"/>
   </div>
   </div>
   </div>
   <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection