@extends('layouts.app')
@section('title','Add Supplier')
@section('breadcrumb','Add Supplier')
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
<form method="post" action="{{url('/supplier/create')}}">
   <h4><span class="heading"> BASIC DETAILS</span></h4>
   <div class="row">
      <div class="col-md-12">
         <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Supplier Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Supplier Name" required="required" autocomplete="off"/>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" name="address" placeholder="Enter Address" required="required"  autocomplete="off"></textarea>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3">
         <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" placeholder="Enter City" required="required" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="district">District:</label>
            <input type="text" class="form-control" name="district" placeholder="Enter District" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="state">State:</label>
            <select name="state" class="form-control select2"  style="width: 100%;" required="required" autocomplete="off">
               <option value="0">Select State</option>
               @foreach($data as $state)
               <option value="{{$state}}">{{$state}}</option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="pincode">Pincode:</label>
            <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" autocomplete="off" />
         </div>
      </div>
   </div>
 
   <div class="row">
      <div class="col-md-3">
         <div class="form-group">
            <label for="sup_pan_no">PAN No:</label>
            <input type="text" class="form-control" name="sup_pan_no" placeholder="Enter PAN" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="gst_no">GST No:</label>
            <input type="text" class="form-control" name="gst_no" required="required"  placeholder="Enter GST No" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="sup_mobile">Mobile No:</label>
            <input type="text" class="form-control" name="sup_mobile" required="required" placeholder="Enter Mobile No." autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="sup_email">Email ID:</label>
            <input type="text" class="form-control" name="sup_email"  placeholder="Enter Email ID" autocomplete="off" />
         </div>
      </div>
   </div>
   <h4><span class="heading"> CONTACT PERSON DETAILS</span></h4>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="contactperson_name">Person Name:</label>
            <input type="text" class="form-control" name="contactperson_name"  placeholder="Contact Person Name" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="contactperson_mobile">Person Mobile:</label>
            <input type="text" class="form-control" name="contactperson_mobile" placeholder="Contact Person Mobile" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="contactperson_email">Person Email:</label>
            <input type="text" class="form-control" name="contactperson_email" placeholder="Contact Person Email" autocomplete="off" />
         </div>
      </div>
   </div>
   <h4><span class="heading"> OWNER DETAILS</span></h4>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="owner_name">Name:</label>
            <input type="text" class="form-control" name="owner_name"  placeholder="Owner Name" autocomplete="off"/>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="owner_mobile">Mobile:</label>
            <input type="text" class="form-control" name="owner_mobile" placeholder="Owner Mobile" autocomplete="off"/>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="owner_email">Email:</label>
            <input type="text" class="form-control" name="owner_email" placeholder="Owner Email" autocomplete="off"/>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea class="form-control" name="remarks" placeholder="Enter Remarks" autocomplete="off"></textarea>
         </div>
      </div>
   </div>
   <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
   </div>
</form>
@endsection