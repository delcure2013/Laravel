//ADD ROW IN TABLE - END
//FORM VALIDATION - START
	function validate() {
		var output = true;

		if ($("#item_add").css('display') != 'none') {
			if (!($("#stockInprice").val())) {
				output = false;
				$("#price-error").html("Price is required");
			}

			if (!($("#stockInqty").val())) {
			output = false;
			$("#qty-error").html("Qty is required");
			}

			if (!($("#item").val())) {
				output = false;
				$("#item-error").html("Item is required");
			}
	
		}
		
			return output;
	}
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

	//FORM VALIDATION - END
 $(document).ready(function(){
	 var rows = 1;
          $(".add-row").click(function(){
			  	var output = validate();
		
			if (output) {
				
				var item = $("#item").val();
				var item_name = $("#item > option:selected").text();
				var qty = $("#stockInqty").val();
				var price = $("#stockInprice").val();
				var total= (parseFloat(qty))*(parseFloat(price));
			
				var markup = "<tr><td width='7%'><input type='checkbox' name='record'></td> \
				<td width='27%'><input type='hidden' class='form-control input-sm' value='"+ item +"' name='item_id"+rows+"'>"+ item_name +"</td> \
				<td width='15%' style='text-align:right'><input type='hidden' class='form-control input-sm' value='"+ qty +"' name='qty"+rows+"'>"+ qty +"</td> \
				<td width='15%' style='text-align:right'><input type='hidden' class='form-control input-sm' value='"+ price +"' name='price"+rows+"'>"+ price +"</td> \
				<td width='20%' style='text-align:right'><input type='hidden' class='form-control totalSum' value='"+ total +"' name='total"+rows+"'>"+ total +"</td> \
				<td width='6%' align='center'><button type='button' class='delete_button btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td> \
				</tr>";

            $('#dynamictable > tbody:last').append(markup);
			calculateSum();
				$('#hdnCount').val(rows);
				rows = rows + 1;

					$("#myFooter").show();
					$("#item-error").hide();
					$("#qty-error").hide();
					$("#price-error").hide();
					$("#item").val('default');
					$("#item").select2("val", "");
					$("#stockInqty").val("");
					$("#stockInprice").val("");
			  	
			   }
			
          });
	 
          // Find and remove selected table rows
          $(".delete-row").click(function(){
              $("table tbody").find('input[name="record"]').each(function(){
              	if($(this).is(":checked")){
                      $(this).parents("tr").remove();
                  }
              });
          });
	
		  
		  $( "#dynamictable" ).on( "click", ".delete_button", function(e) {
			   e.preventDefault();
			   $(this).parents( "tr" ).remove();
			  calculateSum();
			});
      }); 
	//ADD ROW IN TABLE - END