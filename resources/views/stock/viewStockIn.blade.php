@extends('layouts.app')
@section('title','Edit Stock In')
@section('breadcrumb','Edit Stock In')
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
<form method="post" action="{{action('StockInController@update', $id)}}" >
   <div class="row">
      <div class="col-md-5">
         <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Supplier Name:</label>
            <select name="supplier" class="form-control select2" readonly>
          <option value="">Supplier Name:</option>
         @foreach($suppliers as $supplier)
         <option value="{{ $supplier->id}}" {{ ( $supplier->id == $stockin->supplier_id) ? 'selected' : '' }}>{{ $supplier->name}}</option>
         @endforeach
            </select>
			

         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="name">Check In Date:</label>
            <div class="input-group date">
               <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
               </div>
               <input type="text" style="border: 0px;background-color: #DBEAF5;" readonly="true" class="form-control pull-right" value="{{$stockin->check_in_date}}" name="check_in" id="check_in" autocomplete="off">
            </div>
         </div>
      </div>
   </div>
  
   <div class="row">
      <div class="col-md-12">
         <h4><span class="heading">Added Item details</span></h4>
         <div id="item_add">
         
			 <div class="row">
			 <div class="col-md-12">
            <div class="table-responsive">
               <table id="dynamictable" class="table table-bordered table-striped" style="width:100%;">
                  <thead>
                     <tr class="btn-default">
                        <th>Sr. No</th>
                        <th>Item Name</th>
                        <th style='text-align:right'>Qty</th>
                        <th style='text-align:right'>Price</th>
						<th style='text-align:right'>Total</th>
                      
                     </tr>
                  </thead>
                  <tbody>
				      @foreach($supplyin_items as $s)
				  <tr>
				  <td width='7%'>{{$loop->iteration}}</td>
				  <td width='27%'>{{ $s->item_name }}</td>
				  <td style="width:15%;text-align:right">{{ $s->qty }}</td>
				<td style="width:15%;text-align:right">{{ $s->price }}</td>
				<td style="width:20%;text-align:right">{{ ($s->qty) * ($s->price)}} <input type="hidden" class="totalSum" value="{{ ($s->qty) * ($s->price)}}" /></td>
				
				  </tr>
				  @endforeach
                  </tbody>
				   <tfoot id="myFooter">
								<tr>
								<td colspan="3"></td>

								<td style="text-align:right;"><b>Grand Total:</b> </td>
								<td align="right">
								<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-rupee"></i>
								</span>
								<input type="text" id="totalPrice" class="form-control totalPrice" style="text-align:right; font-weight: bold" readonly />
								</div>
								</td>
							
								</tr>
								</tfoot>
               </table>
            </div>
         
			</div>
			</div>
         </div>
      </div>
   </div><br />
      <div class="row">
      <div class="col-md-12">
   <div class="form-group">
      <label for="description">Remarks:</label>
      <textarea type="text" rows="5" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks" autocomplete="off" readonly>
	  {{$stockin->remarks}}
      </textarea>
   </div>
   </div>
   </div>
  <a href="{{url('/stock/index')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
</form>
@endsection
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
   jQuery(document).ready(function(){
	   calculateSum();
	    function calculateSum() {
   
   var sum = 0;
   //iterate through each td based on class and add the values
   	$(".totalSum").each(function() {
   
   		//add only if the value is number
   		if(!isNaN(this.value) && this.value.length!=0) {
   			sum += parseFloat(this.value);
   		}
   
   	});
	$('#totalPrice').val(sum);  
   	//$('.totalPrice').html(sum.toFixed(2));  
   	
   }
$(".deleteRecord").click(function(){

   
    var token = $("meta[name='csrf-token']").attr("content");
	 var id = $(this).data("id");
     confirm("Are You sure want to delete !");
    $.ajax(
    {
        url: "../destroyItems/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data){
            $( "<div class='alert alert-success'>"+ data.success +"</div>" ).prependTo( ".container" );
						$('.alert-success').show();
        }
    });
   
});
  });
</script>