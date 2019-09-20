@extends('layouts.app')
@section('title','Unit List')
@section('breadcrumb','Units')
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
</div>
<br />
@endif
<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUnit"><i class="fa fa-plus-square"></i> ADD NEW UNIT</button>
<table class="table table-striped table-bordered" id="unit_list" style="font-size:10pt">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <th>Description</th>
         <th style="text-align:center">Status</th>
         <th style="text-align:center">Action</th>
      </tr>
   </thead>
   <tbody>
      @foreach($units as $unit)
      <tr>
         <td width="10%">{{$loop->iteration}}</td>
         <td width="25%">{{$unit->name}}</td>
         <td width="30%">{{$unit->description}}</td>
         <td width="15%"  style="text-align:center"> 
            @if($unit->is_active==1)
            <span class="label label-success">Active</span>
            @else
            <span class="label label-warning">Inactive</span>
            @endif
         </td>
         <td width="20%" style="text-align:center">
            <form action="{{action('UnitController@destroy',$unit->id) }}" method="post">
               <a class="btn btn-sm btn-primary" onclick="getInfo('{{$unit->id}}');" data-toggle="modal" data-target="#editunit"><i class="fa fa-pencil"></i> </a>
               {{csrf_field()}}
               <!--	<input name="_method" type="hidden" value="DELETE">
                  <button class="btn btn-default" type="submit" onclick="return confirm('Are you sure want to delete??')"  title="delete"><i class="fa fa-trash"></i></button>-->
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
{{ $units->links() }}
@endsection
<!-- Edit location modal -->
<div class="modal fade" id="editunit">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit unit</h4>
         </div>
         <form method="POST" action="{{url('/unit/update')}}">
            <div class="modal-body">
               {{ csrf_field() }}
               <div class="form-group">
                  <label for="name">Name:</label>
                  <input id="name" name="name" type="text" class="form-control" placeholder="Enter unit name"  required/>
                  <input id="id" name="id" type="hidden"/>
               </div>
               <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea class="form-control" rows="5" name="description" id="description" placeholder="Enter unit description"></textarea>
               </div>
               <div class="form-group">
                  <label for="is_active">Status:</label>
                  <select class="form-control" id="is_active" name="is_active">
                     <option value=""></option>
                     <option value="1">Active</option>
                     <option value="0">Inactive</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm">SAVE</button>  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CLOSE</button>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- Add location modal -->
<div class="modal fade" id="addUnit">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add new unit</h4>
         </div>
         <form method="POST" action="{{url('/unit/create')}}">
            <div class="modal-body">
               {{ csrf_field() }}
               <div class="form-group">
                  <label for="name">Name:</label>
                  <input id="name" name="name" type="text" class="form-control" placeholder="Enter unit name"  required/>
               </div>
               <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea class="form-control" rows="5" name="description" id="description" placeholder="Enter unit description"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm">SAVE</button>
               <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CLOSE</button>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
   crossorigin="anonymous"></script>
<script>
   function getInfo(r) {
       $.ajax({     
   url: 'view/'+r,
   type: 'GET',
   beforeSend: function (request) {
     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
   },
   success: function (response) {
   document.getElementById("name").value = response.name;
   document.getElementById("description").value = response.description;
   document.getElementById("is_active").value = response.is_active;
   document.getElementById("id").value = response.id;
           }
       });  
   } 
</script>
<script>
   $(document).ready(function() {
    $('#unit_list').DataTable( {
        "paging":   false
    } );
   } );
</script>