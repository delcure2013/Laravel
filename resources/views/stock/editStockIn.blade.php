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
            <select name="supplier" class="form-control select2">
          <option value="">Supplier Name:</option>
         @foreach($suppliers as $supplier)
         <option value="{{ $supplier->id}}" {{ ( $supplier->id == $stockin->supplier_id) ? 'selected' : '' }}>{{ $supplier->name}}</option>
         @endforeach
            </select>

         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <br />
            <a href="{{url('/supplier/create')}}" class="btn btn-success btn-sm" style="margin-top:5px"><i class="fa fa-plus"></i> Add Supplier</a>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-5">
         <div class="form-group">
            <label for="name">Check In Date:</label>
            <div class="input-group date">
               <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
               </div>
               <input type="text" class="form-control pull-right datepicker" value="{{$stockin->check_in_date}}" name="check_in" id="check_in" autocomplete="off">
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <h4><span class="heading">Add Items</span></h4>
         <div id="item_add">
            <div class="row">
               <div class="form-group col-md-3">
                  <label for="doc" class="text-normal m-bottom p-bottom-5">Item Name: </label><br>
                  <select class="form-control select2" id="item" name="item">
                     <option value="">Select Items</option>
                     @foreach($items as $item)
                     <option value="{{ $item->id}}">{{ $item->name}} ({{$item->brand_name}})</option>
                     @endforeach
                  </select>
                  <span id="item-error" style="color:#C51818; font-weight:bold"></span>
               </div>
               <div class="form-group col-md-3">
                  <label for="doc" class="text-normal m-bottom p-bottom-5">Qty: </label><br>
                  <input class="itemName form-control" style="width:250px" id="stockInqty" name="stockInqty" placeholder="Enter Qty" />
                  <span id="qty-error" style="color:#C51818; font-weight:bold"></span>
               </div>
               <div class="form-group col-md-3">
                  <label for="doc" class="text-normal m-bottom p-bottom-5">Price per item: </label><br>
                  <input class="itemName form-control" style="width:250px" id="stockInprice" name="stockInprice" placeholder="Enter Price" />
                  <span id="price-error" style="color:#C51818; font-weight:bold"></span>
               </div>
               <div class="form-group col-md-3"  id="addrow">
                  <label for="add-row" class="text-normal m-bottom p-bottom-5"></label><br />
                  <button class="add-row btn btn-primary" name="add-row" type="button" style="margin-top:5px">Add</button>
               </div>
               <!-- /form-group-->
            </div>
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
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
				      @foreach($supplyin_items as $s)
				  <tr id="{{ $s->id }}">
				  <td width='7%'>{{$loop->iteration}}</td>
				  <td width='27%'>{{ $s->item_name }}</td>
				  <td style="width:15%;text-align:right">{{ $s->qty }}</td>
				<td style="width:15%;text-align:right">{{ $s->price }}</td>
				<td style="width:20%;text-align:right">{{ ($s->qty) * ($s->price)}} <input type="hidden" class="totalSum" value="{{ ($s->qty) * ($s->price)}}" /></td>
				<td style="width:6%;text-align:center">
					
					
    
			<button type="button" name="nothing" class="btn btn-danger btn-sm deleteRecord" data-id="{{ $s->id }}" ><i class="fa fa-trash"></i></button>
				<!--	<form action="{{action('StockInController@destroyItems', $s->id) }}" method="post">
					{{csrf_field()}}
					<input name="_method" type="hidden" value="DELETE">
					<button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure want to delete??')"  title="delete"><i class="fa fa-trash"></i></button>
					</form>-->
					
					</td>
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
								<td></td>
								</tr>
								</tfoot>
               </table>
            </div>
            <input type="hidden" id="hdnCount" name="hdnCount">
			
            <button type="button" class="delete-row btn btn-sm btn-danger" ><i class="fa fa-trash"></i> Delete Row</button>
			</div>
			</div>
         </div>
      </div>
   </div><br />
    <!-- begin bounce modal -->
 <div class="bounce" style="display:none;position: absolute;z-index: 999;margin: -125px 375px;">
  <div class="bounce1"></div>
  <div class="bounce2"></div>
  <div class="bounce3"></div>
 </div>
      <div class="row">
      <div class="col-md-12">
   <div class="form-group">
      <label for="description">Remarks:</label>
      <textarea type="text" rows="5" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks" autocomplete="off">
	  {{$stockin->remarks}}
      </textarea>
   </div>
   </div>
   </div>
   <button type="submit" class="btn btn-primary">Stock In</button>  <a href="{{url('/stock/index')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
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
	$(".bounce").show();
 var id = $(this).data("id");
   
    var token = $("meta[name='csrf-token']").attr("content");
	
     
    $.ajax(
    {
        url: "../destroyItems/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data){
          $( "tr#"+id ).remove();
		  calculateSum();
		  $(".bounce").hide();
        }
    });
   
});
  });
</script>