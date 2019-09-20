@extends('layouts.app')
@section('title','View Supplier')
@section('breadcrumb','View Supplier')
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
   <div class="row">
      <div class="col-md-6">
         <h4><span class="heading"> BASIC DETAILS</span></h4>
         <input type="hidden" value="{{csrf_token()}}" name="_token" />
         <table class="table table-bordered table-striped">
            <tr>
               <th width="30%">Supplier Name:</th>
               <td>{{$supplier->name}}</td>
            </tr>
            <tr>
               <th>Address:</th>
               <td>{{$supplier->address}}</td>
            </tr>
            <tr>
               <th>City:</th>
               <td>{{$supplier->city}}</td>
            </tr>
            <tr>
               <th>District:</th>
               <td>{{$supplier->district}}</td>
            </tr>
            <tr>
               <th>State:</th>
               <td>{{$supplier->state}}</td>
            </tr>
            <tr>
               <th>Pincode:</th>
               <td>{{$supplier->pincode}}</td>
            </tr>
         </table>
      </div>
      <div class="col-md-6">
     <!--    <h4><span class="heading"> GST DETAILS</span></h4>-->
	 <br /> <br />
         <table class="table table-bordered table-striped">
            <tr>
               <th width="30%">PAN No:</th>
               <td>{{$supplier->pan_no}}</td>
            </tr>
            <tr>
               <th>GST No:</th>
               <td>{{$supplier->gst_no}}</td>
            </tr>
            <tr>
               <th>Mobile No:</th>
               <td>{{$supplier->mobile}}</td>
            </tr>
            <tr>
               <th>Email ID:</th>
               <td>{{$supplier->email}}</td>
            </tr>
         </table>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <h4><span class="heading"> CONTACT PERSON DETAILS</span></h4>
         <table class="table table-bordered table-striped">
            <tr>
               <th width="30%">Name:</th>
               <td>{{$supplier->contact_person_name}}</td>
            </tr>
            <tr>
               <th>Mobile:</th>
               <td>{{$supplier->contact_person_mobile}}</td>
            </tr>
            <tr>
               <th>Email:</th>
               <td>{{$supplier->contact_person_email}}</td>
            </tr>
         </table>
      </div>
      <div class="col-md-6">
         <h4><span class="heading"> OWNER DETAILS</span></h4>
         <table class="table table-bordered table-striped">
            <tr>
               <th width="30%">Name:</th>
               <td>{{$supplier->owner_name}}</td>
            </tr>
            <tr>
               <th>Mobile:</th>
               <td>{{$supplier->owner_mobile}}</td>
            </tr>
            <tr>
               <th>Email:</th>
               <td>{{$supplier->owner_email}}</td>
            </tr>
         </table>
      </div>
   </div>
   <div class="row">
      <div class="col-md-4">
         <div class="form-group">
            <label for="name">Remarks:</label>
            <textarea class="form-control" name="remarks">{{$supplier->remarks}}</textarea>
         </div>
      </div>
   </div>
   <a href="{{url('/supplier/index')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
</form>
@endsection