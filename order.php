<?php
//order.php

include('database_connection.php');
include('connection.php');
include('function.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

include('header.php');


?>
	<link rel="stylesheet" href="css/datepicker.css">
	<script src="js/bootstrap-datepicker1.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

	<script>
	$(document).ready(function(){
		$('#inventory_order_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});
	});
	</script>

	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			
			<div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                    	<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            <h3 class="panel-title">Order List</h3>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
							<button type="button" name="add" id="add_button" class="btn btn-success btn-sm"><i class="fa fa-shopping-basket"></i> Add</button> 
							<button type="button" name="add" id="return_button" class="btn btn-danger btn-sm"><i class="fas fa-undo"></i> Return</button>    
							<!-- <a href="add_order.php" target="_blank" class="btn btn-success btn-sm"> <i class="fa fa-shopping-basket"></i> Add</a> 	 -->
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                	<table id="order_data" class="table table-bordered table-striped" style="font-size: 14px;">
                		<thead>
							<tr>
								<th>Id</th>
								<th width="10%">Order date</th>
								<th>Customer Name</th>
								<th width="20%">Address</th>
								<th>Order Total</th>	
								<!-- <th>Courier Charge</th>	 -->			
								<th>Payment Status</th>
								<!-- <th>Delivery By</th>
								<th>Remarks</th> -->
								<th>View</th>
								<th>Update</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
                    <!-- PHP Blocks -->
							<?php
							$fetch_product_query = 'SELECT * FROM inventory_order ORDER BY order_id DESC';
							$Execute = mysqli_query($conn, $fetch_product_query);
								$serial = 0;
							while ($row = mysqli_fetch_assoc($Execute)) {
								$serial = $serial + 1;
								$order_id = $row['order_id'];
								$order_date = $row['order_date'];
								$customer_name = $row['customer_name'];
								$customer_mobile = $row['customer_mobile'];
								$customer_address = $row['customer_address'];
								$order_total = $row['order_total'];
								$cod = $row['shipping_charge'];
								$courier_charge = $row['courier_charge'];
								$order_from = $row['order_from'];
								$order_status = $row['order_status'];
								$payment_status = $row['payment_status'];
								$delivery_by = $row['delivery_by'];
								$remarks = $row['remarks'];
								 ?>

							<tr>
							<td  ><?php  echo $order_id; ?></td>
							<td  ><?php  echo $order_date; ?></td>
							<td  ><?php  echo $customer_name; ?></td>
							<td  ><?php  echo $customer_address; ?></td>
							<td><?php  echo $order_total; ?></td>

							<!-- <td><?php  echo $courier_charge; ?></td> -->
							
						
							<td><?php  echo $payment_status; ?></td>
							<!-- <td><?php  echo $delivery_by; ?></td> -->
							<!-- <td><?php  echo $remarks; ?></td> -->
							<td align="center"  ><a href="view_order.php?order_id=<?php echo $order_id; ?>" target="_blank" id="<?php echo $order_id;  ?>" class="btn btn-success btn-sm"><i class="far fa-file-alt"></i></a>
							</td>
							<td align="center">
							<a id="<?php echo $order_id;  ?>"  class="update_order btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
							</td >
							<td align="center">
							<a id="<?php echo $order_id;  ?>"  class="delete_order btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
							</td>
								
							
							</tr>
						<?php
							}
						?>




                </tbody>

                	</table>
                </div>
            </div>
        </div>
    </div>

    <div id="orderModal" class="modal fade">

    	<div class="modal-dialog">
    		<div method="post" id="order_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Create Order</h4>
    				</div>
    				<div class="modal-body">
    					<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Customer Name</label>
									<input type="text" name="customer_name" id="customer_name" class="form-control" required />
									<input type="hidden" name="order_id" id="order_id" class="form-control" value="<?php echo get_last_order_id($conn);  ?>" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Customer Mobile</label>
									<input type="text" name="customer_mobile" id="customer_mobile" class="form-control" required />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea name="customer_address" id="customer_address" class="form-control" required></textarea>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Payment Method</label>
									<select name="payment_method" id="payment_method" class="form-control">
										<option>COD</option>
										<option>bKash</option>
										<option>Hand Cash</option>
										<option>SSL</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Order From</label>
									<select name="order_from" id="order_from" class="form-control">
										<option>Facebook</option>
										<option>Online</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Refrence No</label>
									<input type="text" name="refrence_no" id="refrence_no" class="form-control" required />
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							
								<div class="row" style="margin-bottom: 10px;">
									<div class="col-lg-6">
										<label>Enter Product Details</label>
										<input type="hidden" name="order_id" id= "order_id" value="<?php echo get_last_order_id($conn);   ?>">
									</div>
									<div align="right" class="col-lg-6">
										<button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
									</div>
								</div>
								
								<div class="row">
								<div class="col-lg-12">
                				<table class="table table-responsive"  id="crud_table">
                    			<tbody  id="append_row">
									<tr>
										<th width="30%">Code</th>
										<th width="15%">Quantity</th>
										<th width="20%">Size</th>
										<th width="30%">Total</th>
										<th width="5%"></th>
									</tr>
									<tr>
										<td width="30%"><select type="text" id="product_code1" class="product_code form-control input-md"> 
										<option selected disabled> Select Code </option>
										<?php echo fill_product_code($connect);   ?>
										</select>
										</td>
											<input value=0  type="hidden" id="product_name1" class="product_name form-control input-md">
											<td><input value=0  type="text" id="product_quantity1" class="product_quantity form-control input-md"></td>
											<td ><input style='text-transform:uppercase'   type="text" id="product_size1" class="product_size form-control input-md"></td>
											<input value=0  type="hidden" id="product_price1" class="product_price form-control input-md">
											<input value=0  type="hidden" id="discount1" class="discount form-control input-md">
											<td ><input value=0  type="text" id="total1" class="total form-control input-md" readonly></td>
										<td></td>
									</tr>
                        
                        
											</tbody>
											<tfoot>
											<tr>
												<td colspan="3">
													<select type='text' id='shipping_charge' class="form-control input-md">
														<option selected> Free Shipping </option>
														<option> Flat Rate </option>
													</select>
												</td>
												<td><input type="text" id="shipping_charge_amount" class="shipping_charge_amount form-control input-md" value=0 readonly></td>
												</tr>
											</tfoot>
											
										</table>

									
								</div>


						</div>		
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Order Total</label>
									<input class="form-control" type="number" id="order_total" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>COD</label>
									<input class="form-control" type="number" id="cod" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Courier Charge</label>
									<input class="form-control" type="number" id="courier_charge" value=0>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Payment Status</label>
									<select name="payment_status" id="payment_status" class="form-control">
										<option>Pending</option>
										<option>Complete</option>
									</select>
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Delivery By</label>
									<select name="delivery_by" id="delivery_by" class="form-control">
										<option selected>Unbooked</option>
										<option>Pathao</option>
										<option>Showroom</option>
										<option>Emergency</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col-lg-12" >
								<div class="form-group">
										<label>Remarks</label>
										<input class="form-control"  type="text" id="remarks">
								</div>
							</div>
						</div>
						
    				</div>
    				<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="save_order" class="btn btn-primary">Save</button>
                    </div>
    			</div>
			</div>
    	</div>

    </div>
	<div id="update_order_modal" class="modal fade">

    	<div class="modal-dialog">
    		<div method="post" id="order_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-edit"></i> Update Order</h4>
    				</div>
    				<div class="modal-body">
    					<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Customer Name</label>
									<input type="text" name="customer_name_update" id="customer_name_update" class="form-control"  />
									<input type="hidden" name="order_id_update" id="order_id_update" class="form-control" value="<?php echo get_last_order_id($conn);  ?>"  />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Customer Mobile</label>
									<input type="text" name="customer_mobile_update" id="customer_mobile_update" class="form-control"  />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea name="customer_address_update" id="customer_address_update" class="form-control" ></textarea>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Payment Method</label>
									<select name="payment_method_update" id="payment_method_update" class="form-control">
										<option>COD</option>
										<option>bKash</option>
										<option>Hand Cash</option>
										<option>SSL</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Order From</label>
									<select name="order_from_update" id="order_from_update" class="form-control">
										<option>Facebook</option>
										<option>Online</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Refrence No</label>
									<input type="text" name="refrence_no_update" id="refrence_no_update" class="form-control"  />
									</select>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Order Total</label>
									<input class="form-control" type="number" id="order_total_update" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Courier Charge</label>
									<input class="form-control" type="hidden" id="cod_update" >
									<input class="form-control" type="number" id="courier_charge_update" >
								</div>
							</div>
							
							
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label>Payment Status</label>
										<select name="payment_status" id="payment_status_update" class="form-control">
											<option>Pending</option>
											<option>Complete</option>
		
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Delivery By</label>
										<select name="delivery_by_update" id="delivery_by_update" class="form-control">
										<option selected>Unbooked</option>
										<option>Pathao</option>
										<option>Showroom</option>
										<option>Emergency</option>
		
										</select>
									</div>
								</div>
						</div>

						<div class="row" >
							<div class="col-lg-12" >
								<div class="form-group">
										<label>Remarks</label>
										<input class="form-control"  type="text" id="remarks_update">
								</div>
							</div>
						</div>
						
    				</div>
    				<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="save_order_update" class="btn btn-primary">Save</button>
                    </div>
    			</div>
			</div>
    	</div>

  </div>
		
  <div id="return_order_modal" class="modal fade">

<div class="modal-dialog">
	<div method="post" id="order_form">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-undo"></i> Return Order</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Invoice No</label>
							<input type="number" name="invoice_no" id="invoice_no" class="form-control"  />
						</div>
					</div>
					<div >
					<div class="col-md-4">
						<div class="form-group">
							<input type="hidden" name="return_stock" id="return_stock" class="form-control"  />
						</div>
					</div>
					</div>
				</div>	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="save_return_order" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript">
    $(document).ready(function(){

			var count = 1;

		function calculate_order_total(){
			var sum = 0;
			var shipping_charge = parseInt($('#shipping_charge_amount').val());
    
			$(".total").each(function() {

				//add only if the value is number
				if(!isNaN(this.value) && this.value.length!=0) {
					sum += parseFloat(this.value);
				}
			});
			$('#order_total').val(sum+shipping_charge); 
		}

		function calculate_cod(){

			var payment_method = $('#payment_method').val();
			var order_total = parseInt($('#order_total').val());

			if(payment_method == "COD"){
				$('#cod').val(order_total*0.01); 
			}else{
				$('#cod').val(0); 
			}

			
		}

		$("#payment_method").change(function(){
			calculate_cod();
		})

		$(document).on('click','.delete_order', function(){
			var order_id = $(this).attr("id");
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.value) {
					$.ajax({
						url: "delete_order.php",
						method: "POST",
						data:{order_id:order_id },
						success: function(data){
						if (data=="Done") {
							Swal({
								title: 'Order Deleted Successfully!',
								type: 'success',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Ok'
							}).then((result) => {
								if (result.value) {
								window.location.reload();
								}
							})  
						}else{
							alert(data);
						}
						}
					})
				}
				})
		})

	
		$("#add_button").click(function(){
			$("#orderModal").modal("show");
		})
		$("#shipping_charge").change(function(){
			var shipping_charge = $("#shipping_charge").val();
			if(shipping_charge == "Free Shipping"){
				$('#shipping_charge_amount').val(0);
			}else if(shipping_charge == "Flat Rate"){
				$('#shipping_charge_amount').val(100);
			}
			calculate_order_total();
			calculate_cod();
		});
		$("#add").click(function(){
			count = count+1;
			var html_code = "";
			var html_code = "<tr id='row"+count+"'>";
			html_code += "<td><select type='text' id='product_code"+count+"' class='product_code form-control input-md' > <option selected disabled> Select Code</option>"
			html_code+="<?php echo fill_product_code($connect); ?></select></td>";
			html_code += "<input type='hidden' id='product_name"+count+"' class='product_name form-control input-md' >";
			html_code += "<td><input type='text' value=0  id='product_quantity"+count+"' class='product_quantity form-control input-md' ></td>";
			html_code += "<td><input type='text' style='text-transform:uppercase;' id='product_size"+count+"' class='product_size form-control input-md' ></td>";
			html_code += "<input type='hidden' value=0  id='product_price"+count+"' class='product_price form-control input-md' >";
			html_code += "<input type='hidden' value=0  id='discount"+count+"' class='discount form-control input-md' >";
			html_code += "<td><input type='text' value=0  id='total"+count+"' class='total form-control input-md' readonly ></td>";
			html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-sm remove'><i class='fas fa-times'></i></button></td>";   
    		html_code += "</tr>";  
			$('#append_row').append(html_code);
		})
		$(document).on('click', '.remove', function(){
			var delete_row = $(this).data("row");
			$('#' + delete_row).remove();
			count--;
			calculate_order_total();P
			calculate_cod();
		});

		$('.product_size').keyup(function() {
	     MakeUppercase();
		});

		$(document).on('change','.product_code', function(){
			var product_code = $(this).val();
			var row_id = $(this).attr("id");
			var stringLength = row_id.length; 
			var count = row_id.charAt(stringLength - 1)

			$.ajax({
				url:"get_product_detail.php",
				method:"POST",
				data:{product_code:product_code},
				dataType:"json", 
				success:function(data){
					$('#product_name'+count).val(data.product_name);
					$('#product_price'+count).val(data.product_price);
					$('#discount'+count).val(data.discount);
					var product_price =  $('#product_price'+count).val();
					var productQuantity =  $('#product_quantity'+count).val();
					var discount =  $('#discount'+count).val();
					var discount_percent = parseInt(discount)/100;
					var total_discount = parseInt(product_price)*parseFloat(discount_percent);
					var product_special_price = parseFloat(product_price)-parseFloat(total_discount);
					$('#total'+count).val(product_special_price*parseInt(productQuantity));
					calculate_order_total();
					calculate_cod();
			}
			});
		})
		function calculate_row_total(count)
  {
            var total = 0;
            for(j=1; j<=count; j++)
            {
            var  quantity = $('#product_quantity'+j).val();
            var price = $('#product_price'+j).val();
			var discount = $('#discount'+j).val();
			var total_discount = parseInt(price)*(discount/100);
            total = parseInt(quantity) * (parseInt(price)-parseInt(total_discount));
            $("#total"+j).val(total);
            }
  }
  // Calculate Product Quantity Script
  $(document).on('keyup', '.product_quantity', function(){
	calculate_row_total(count);
	calculate_order_total();
	calculate_cod();
  });

  // Save Order
  $("#save_order").click(function(){
	  var order_id = $("#order_id").val();
	  var customer_name = $("#customer_name").val();
	  var customer_mobile = $("#customer_mobile").val();
	  var customer_address= $("#customer_address").val();
	  var payment_method = $("#payment_method").val();
	  var order_from = $("#order_from").val();
	  var refrence_no = $("#refrence_no").val();
	  var shipping_charge = $("#shipping_charge_amount").val();
	  var order_total = $("#order_total").val();
		var cod = $("#cod").val();
		var courier_charge = $("#courier_charge").val();
	  var order_status = $("#order_status").val();
	  var payment_status = $("#payment_status").val();
		var delivery_by = $("#delivery_by").val();
		var remarks = $("#remarks").val();

	  //Product Details
	  	var product_code = [];
		var product_name = [];
		var product_quantity = [];
		var product_size = [];
		var product_price = [];
		var discount = [];
		var total = [];
		$('.product_code').each(function(){
		product_code.push($(this).val());
		});
		$('.product_name').each(function(){
		product_name.push($(this).val());
		});
		$('.product_quantity').each(function(){
		product_quantity.push($(this).val());
		});
		$('.product_size').each(function(){
		product_size.push($(this).val());
		});
		$('.product_price').each(function(){
		product_price.push($(this).val());
		});
		
		$('.discount').each(function(){
		discount.push($(this).val());
		});
		$('.total').each(function(){
		total.push($(this).val());
		});	
		/***************************/
		
		$.ajax({
		url: "add_order.php",
		method: "post",
		data:{
		order_id: order_id,
		customer_name: customer_name,
		customer_mobile: customer_mobile,
		customer_address: customer_address,
		payment_method: payment_method,
		order_from: order_from,
		refrence_no: refrence_no,
		shipping_charge: shipping_charge,
		order_total: order_total,
		cod: cod,
		courier_charge: courier_charge,
		order_status: order_status,
		payment_status: payment_status,
		delivery_by: delivery_by,
		remarks: remarks,
		product_code: product_code,
		product_name: product_name,
		product_quantity: product_quantity,
		product_size: product_size,
		product_price: product_price,
		discount: discount,
		total: total
		},
		success: function (data){
			if(data=="Done"){
                Swal({
                        title: 'Order Added Successfully',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.value) {
                           window.location.reload();
                        }
                      })
                 
                }
                else{

                    Swal({
                        type: 'error',
                        title: 'Cannot Add Order....!',
                        confirmButtonColor: "#f8173c"
                      })
				}
		}




   })
  })

  $(".update_order").click(function(){
	var order_id =   $(this).attr("id");

	$.ajax({
		url: "get_order_details.php",
		method: "POST",
		data: {order_id: order_id},
		success: function(data){
			// alert(data);
			var result = JSON.parse(data);
			$('#order_id_update').val(result.order_id);
			$('#customer_name_update').val(result.customer_name);
			$('#customer_mobile_update').val(result.customer_mobile);
			$('#customer_address_update').val(result.customer_address);
			$('#payment_method_update').val(result.payment_method);
			$("#order_from_update").val(result.order_from);
			$("#refrence_no_update").val(result.reference_no);
			$("#shipping_charge_amount_update").val(result.shipping_charge);
			$("#order_total_update").val(result.order_total);
			$("#cod_update").val(result.cod);
			$("#courier_charge_update").val(result.courier_charge);
			$("#order_status_update").val(result.order_status);
			$("#payment_status_update").val(result.payment_status);
			$("#remarks_update").val(result.remarks);
			$("#update_order_modal").modal("show");


		} 
	})


	})
	

	$("#save_order_update").click(function(){
	var order_id = $("#order_id_update").val();
	  var customer_name = $("#customer_name_update").val();
	  var customer_mobile = $("#customer_mobile_update").val();
	  var customer_address = $("#customer_address_update").val();
	  var payment_method = $("#payment_method_update").val();
	  var order_from = $("#order_from_update").val();
	  var refrence_no = $("#refrence_no_update").val();
	  var shipping_charge = $("#shipping_charge_amount_update").val();
	  var order_total = $("#order_total_update").val();
		var cod = $("#cod_update").val();
		var courier_charge = $("#courier_charge_update").val();
	  var payment_status = $("#payment_status_update").val();
		var delivery_by = $("#delivery_by_update").val();
		var remarks = $("#remarks_update").val();


	  $.ajax({
		  url:"update_order.php",
		  method:"POST",
		  data: {
			order_id: order_id,
			customer_name: customer_name,
			customer_mobile: customer_mobile,
			customer_address: customer_address,
			payment_method: payment_method,
			order_from: order_from,
			refrence_no: refrence_no,
			order_total: order_total,
			cod: cod,
			courier_charge: courier_charge,
			payment_status: payment_status,
			delivery_by: delivery_by,
			remarks: remarks
		  },
		  success: function(data){
			if(data=="Done"){
                Swal({
                        title: 'Order Updated Successfully',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.value) {
                           window.location.reload();
                        }
                      })
                 
                }
                else{

                    Swal({
                        type: 'error',
                        title: 'Cannot Update Order....!',
                        confirmButtonColor: "#f8173c"
                      })
				}

		  }

	  })
	 
	})
	$("#return_button").click(function(){
		$("#return_order_modal").modal("show");
	  })

	$("#product_code_return").change(function(){
		var product_code = $("#product_code_return").val();
		$.ajax({
			url: "get_product_detail.php",
			method: "post",
			data: {product_code: product_code},
			success: function(data){
				var result = JSON.parse(data);
				$("#return_stock").val(result.product_returns);
			}
		})
	})

	$("#save_return_order").click(function(){
	var invoice_no = 	$("#invoice_no").val();
	var product_code = $("#product_code_return").val();
	// var product_quantity = parseInt($("#product_quantity_return").val());
	// var product_return_stock = parseInt($("#return_stock").val());
	// var total_return = product_quantity + product_return_stock;

	if(invoice_no ==""){
		alert("All fields are required");
	}else{
		$.ajax({
			url:"return_order.php",
			method: "post",
			data: { invoice_no: invoice_no, product_code: product_code},
			success: function(data){
				
				if(data=="Done"){
                Swal({
                        title: 'Product Returned Successfully',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.value) {
                           window.location.reload();
                        }
                      })
                 
                }
                else{
                    Swal({
                        type: 'error',
                        title: 'Cannot Return Product....!',
                        confirmButtonColor: "#f8173c"
                      })
				}


			}
		})
	}

	});

$('#order_data').DataTable({
	"order": [[ 0, "desc" ]]
});
    });
</script>