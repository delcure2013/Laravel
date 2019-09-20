@extends('layouts.app')
@section('title','Stock Assigned')
@section('breadcrumb','List of Stock Assigned')
@section('content')
@if(\Session::has('success'))
<div class="alert alert-success alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   {{\Session::get('success')}}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
<br />
@endif
<!--	<a href="{{url('/stock/createStockIn')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a> -->
<div id="popup">
<table class="table table-striped table-bordered" id="categories_list" style="font-size:11pt">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Issued To</th>
         <th>Issue Date</th>
		 <th>Item Name</th>
         <th>Assigned Qty</th>
         <th style="text-align:center">Action</th>
      </tr>
	 
   </thead>
   <tbody>
      @foreach($stocks as $stock)
      <tr>
         <td width="10%">{{$loop->iteration}}</td>
         <td width="17%">
		@if(!empty($stock->firstname))
		{{$stock->firstname.' '.$stock->lastname}}
	
		@elseif(!empty($stock->other_name))
		{{$stock->other_name}}
		
		@else
		{{$stock->location_name}} 
		@endif
		
	
		 </td>
         <td width="13%">{{$stock->supply_out_date = date("d/m/Y", strtotime($stock->supply_out_date))}}</td>
		 <td width="17%">{{$stock->item_name}} ({{$stock->brand_name}})</td>
         <td width="13%">{{$stock->assign_qty}} </td>
         <td width="20%" style="text-align:center">
		 <form action="{{action('StockAssignController@destroy',$stock->id) }}" method="post">
		<!--	<a href="javascript:void(0);" class="btn btn-sm btn-primary up"><i class="fa fa-pencil"></i> Edit</a>-->
		<a class="btn btn-sm btn-primary up" data-price="{{$stock->price}}" data-item="{{$stock->item_name}}({{$stock->brand_name}})" data-avl_qty="{{$stock->avl_qty}}" onclick="getInfo('{{$stock->id}}');"><i class="fa fa-pencil"></i></a>
			{{csrf_field()}}
					<input name="_method" type="hidden" value="DELETE">
					<button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure want to delete??')"  title="delete"><i class="fa fa-trash"></i></button>
				  </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
</div>
{{ $stocks->links() }}
@endsection
<!-- Edit location modal -->
<div class="modal fade stockout" id="stockout">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Stock Out</h4>
         </div>
         <form id="stockoutform" method="POST" action="{{url('/stockAssign/update')}}">
            <div class="modal-body">
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="popupissuedate">Issue Date:</label>
                        <input id="popupissuedate" name="popupissuedate" type="text" class="form-control datepicker" placeholder="Enter issue date" autocomplete="off"  readonly />
                        <input id="id" name="id" type="hidden"  required/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Issue to:</label>
                        
                     </div>
                  </div>
               </div>
              
			   <div class="row">
			   <div class="col-md-12" >

			<div id="exTab3">	
			<ul  class="nav nav-pills ">
						<li class="active">
					<a  href="#1b" data-toggle="tab">Employee</a>
						</li>
						<li><a href="#2b" data-toggle="tab">Location</a>
						</li>
						<li><a href="#3b" data-toggle="tab">Other</a>
						</li>
				
					</ul><br />

			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1b">
         
                     <div class="form-group">
                        <label for="popupempid">Employee:</label><br />
						 <select class="form-control" id="popupempid" name="popupempid" style="width:100%" autocomplete="off" readonly>
						<option value="">Select Employee</option>
                           @foreach($users as $user)
                           <option value="{{$user->id}}">{{ $user->firstname.' '.$user->lastname}}</option>
                           @endforeach
                        </select>
                     </div>
                 
				</div>
				<div class="tab-pane" id="2b">
          
                     <div class="form-group">
                        <label for="location">Location:</label><br />
                        <select class="form-control" id="popuplocid" name="popuplocid" style="width:100%" autocomplete="off" readonly>
                        <option value="">Select Location</option>
                           @foreach($locations as $location)
                           <option value="{{ $location->id}}">{{ $location->name}}</option>
                           @endforeach
                        </select>
                     </div>
                 
				</div>
        <div class="tab-pane" id="3b">
         
                     <div class="form-group">
                        <label for="popothername">Other:</label><br />
                        <input id="popothername" name="popothername" type="text" class="form-control" placeholder="Enter other name" readonly autocomplete="off" />
                     </div>
                
                  
                     <div class="form-group">
                        <label for="popothermob">Mobile:</label><br />
                        <input id="popothermob" name="popothermob" type="text" class="form-control" placeholder="Enter other mobile" readonly autocomplete="off" />
                     </div>
                
				</div>
        
  </div>
			   </div>
			   </div>
			   </div>
            
			    <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="location">Item Name:</label><br />
                        <input id="popupitem" name="popupitem" type="text" class="form-control" readonly required/>
						<input id="popupitemid" name="popupitemid" type="hidden"/>
						<input id="popupsmid" name="popupsmid" type="hidden"/>
						
                     </div>
                  </div>
				  <div class="col-md-4">
                     <div class="form-group">
                        <label for="location">Avl Qty:</label><br />
                        <input id="popupqty" name="popupqty" type="text" class="form-control"  readonly  required/>
                     </div>
                  </div>
				  <div class="col-md-4">
                     <div class="form-group">
                        <label for="location">Price per item:</label><br />
                        <input id="popupprice" name="popupprice" type="text" class="form-control" readonly  required/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="location">Assign no. of items:</label><br />
                        <input id="noofitems" name="noofitems" type="text" class="form-control" placeholder="Enter no. of items" autocomplete="off" required/>
                     </div>
                  </div>
               </div>
			     <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="popupremarks">Remarks:</label><br />
                        <textarea class="form-control" id="popupremarks" name="popupremarks" autocomplete="off"></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm">ASSIGN</button>  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">CLOSE</button>
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
   function getInfo(r) {
     $.ajax({     
   url: 'view/'+r,
   type: 'GET',
   beforeSend: function (request) {
     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
   },
   success: function (response) {
	document.getElementById("popupissuedate").value = response.supply_out_date;
	document.getElementById("popupempid").value = response.employee_id;
	document.getElementById("popuplocid").value = response.location_id;
	document.getElementById("popothername").value = response.other_name;
	document.getElementById("popothermob").value = response.other_mobile;
	document.getElementById("noofitems").value = response.qty;
	document.getElementById("popupremarks").value = response.remarks;
	document.getElementById("id").value = response.id;
           }
       });  
   }

	  
   $(document).ready(function() {
	    //get data for update record
        $('#popup').on('click', '.up', function(){
            var popupitem = $(this).data('item');
			var popupitemid = $(this).data('item_id');
			var popupprice = $(this).data('price');
			var popupqty = $(this).data('avl_qty');
			var popupsmid = $(this).data('sm_id');
			$('#stockout').modal('show');
			$('[name="popupitem"]').val(popupitem);
			$('[name="popupprice"]').val(popupprice);
			$('[name="popupqty"]').val(popupqty);
			$('[name="popupsmid"]').val(popupsmid);
			});
   	
       $('#categories_list').DataTable( {
           "paging":   false
       } );
   } );
</script>