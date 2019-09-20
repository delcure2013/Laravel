@extends('layouts.app')
@section('title','Edit Supplier')
@section('breadcrumb','Edit Supplier')
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
<form method="post" action="{{action('SupplierController@update', $id)}}" >
   <h4><span class="heading"> BASIC DETAILS</span></h4>
   <div class="row">
      <div class="col-md-12">
         <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Supplier Name:</label>
            <input type="text" class="form-control" name="name" value='{{$supplier->name}}' required="required" autocomplete="off"/>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" name="address" required="required" autocomplete="off">{{$supplier->address}}</textarea>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3">
         <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value='{{$supplier->city}}' required="required" autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="district">District:</label>
            <input type="text" class="form-control" name="district" value='{{$supplier->district}}' autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="state">State:</label>
            <select name="state" class="form-control select2" required="required" autocomplete="off">
               <option value="0">Select State</option>
               @foreach($data as $state)
               <option value="{{$state}}" {{ ( $state == $supplier->state) ? 'selected' : '' }} >{{$state}}</option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="pincode">Pincode:</label>
            <input type="text" class="form-control" name="pincode" value='{{$supplier->pincode}}' autocomplete="off" />
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-3">
         <div class="form-group">
            <label for="sup_pan_no">PAN No:</label>
            <input type="text" class="form-control" name="sup_pan_no" value='{{$supplier->pan_no}}' autocomplete="off" />
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="gst_no">GST No:</label>
            <input type="text" class="form-control" name="gst_no" value='{{$supplier->gst_no}}' required="required" autocomplete="off"/>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="sup_mobile">Mobile No:</label>
            <input type="text" class="form-control" name="sup_mobile" value='{{$supplier->mobile}}' autocomplete="off"/>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="sup_email">Email ID:</label>
            <input type="text" class="form-control" name="sup_email" value='{{$supplier->email}}' autocomplete="off"/>
         </div>
      </div>
   </div>
   <h4><span class="heading"> CONTACT PERSON DETAILS</span></h4>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="contactperson_name">Person Name:</label>
            <input type="text" class="form-control" name="contactperson_name" value='{{$supplier->contact_person_name}}' autocomplete="off"/>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="contactperson_mobile">Person Mobile:</label>
            <input type="text" class="form-control" name="contactperson_mobile" value='{{$supplier->contact_person_mobile}}' autocomplete="off" />
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="contactperson_email">Person Email:</label>
            <input type="text" class="form-control" name="contactperson_email" value='{{$supplier->contact_person_email}}' autocomplete="off" />
         </div>
      </div>
   </div>
   <h4><span class="heading"> OWNER DETAILS</span></h4>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="owner_name">Name:</label>
            <input type="text" class="form-control" name="owner_name" value='{{$supplier->owner_name}}' autocomplete="off" />
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="owner_mobile">Mobile:</label>
            <input type="text" class="form-control" name="owner_mobile" value='{{$supplier->owner_mobile}}' autocomplete="off" />
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="owner_email">Email:</label>
            <input type="text" class="form-control" name="owner_email" value='{{$supplier->owner_email}}' autocomplete="off" />
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea class="form-control" name="remarks" autocomplete="off">{{$supplier->remarks}}</textarea>
         </div>
      </div>
   </div>
   <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
<script>
   $(document).ready(function() {
    $('.select2').select2();
    });
</script>