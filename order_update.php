<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon"  sizes="20x20" type="image/ico" href="images/title_logo.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="vendors/SweetAlert2/package/dist/sweetalert2.min.css" />
<title>Update Order</title>
</head>
<body>
    <div class="container">
                    <div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-edit"></i> Update Order  <?php echo $_GET['order_id']  ?></h4>
    				</div>
                    <br>
        <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Customer Name</label>
                                    <input type="hidden" id="order_id_update" class="form-control" value= "<?php echo $_GET['order_id']  ?>"  />
									<input type="text" name="customer_name_update" id="customer_name_update" class="form-control"  />
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
										<option>Unbooked</option>
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

                        <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="save_order_update" class="btn btn-primary">Save</button>
                    </div>
						
    
    
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="vendors/SweetAlert2/package/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        var order_id = $('#order_id_update').val();
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
            $("#delivery_by_update").val(result.delivery_by);
			$("#remarks_update").val(result.remarks);
		} 
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
    });
</script>


</body>
</html>

