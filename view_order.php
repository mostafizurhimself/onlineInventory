<?php
                include('connection.php');
                $order_id = $_GET['order_id'];
                // echo $order_id;
                $fetch_order_details = "SELECT * FROM inventory_order WHERE order_id = '$order_id'";
                $Execute = mysqli_query($conn, $fetch_order_details);
                    $serial = 0;
                while ($row = mysqli_fetch_assoc($Execute)) {
                    $serial = $serial + 1;
                    $order_date = $row['order_date'];
                    $customer_name = $row['customer_name'];
                    $customer_mobile = $row['customer_mobile'];
                    $customer_address = $row['customer_address'];
                    $payment_method = $row['payment_method'];
                    $order_from = $row['order_from'];
                    $reference_no = $row['reference_no'];
                    $shipping_charge = $row['shipping_charge'];
                    $order_total = $row['order_total'];
                    $order_status = $row['order_status'];
                    $payment_status = $row['payment_status'];
                    $payment_method = $row['payment_method'];
                    $delivery_by = $row['delivery_by'];
                }
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>View | Invoice</title>

	<link rel="icon"  sizes="20x20" type="image/ico" href="images/title_logo.png" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="css/invoice.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="vendors/printThis/printThis.js"></script>
</head>
<body>
<div id="inventory-invoice">

    <!-- <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
        </div>
        <hr>
    </div> -->
    <div class="invoice overflow-auto">
		<div style="min-width: 600px">
			<header>
					<div class="row">
						<div class="col">
							<div class="row">
								<div  style="margin:10px;"> 
									<img src="images/invoice_logo.png" alt="Company Logo" height="100px">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">	
								<img src="images/qr_code.jpg" alt="QR CODE" height="100px">
							</div>
						</div>
					</div>
				</header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $customer_name;  ?></h2>
                        <div class="address"><h4><strong> <?php echo $customer_address;  ?></strong></h4></div>
                        <div class="email"> <h4><strong> Mobile: <?php echo $customer_mobile;  ?> </strong></h4></div>
                        <div class="email"><h5><strong> Payment Method: <?php echo $payment_method;  ?> </strong></h5></div>
                    </div>
                    <div class="col invoice-details">
                        <h1>INVOICE <?php echo $order_id;  ?></h1>
                        <div class="date"><h4><strong>Date of Invoice: <?php echo $order_date;  ?></strong></h4></div>
                        <div class="date"><h4><strong>Reference No: <?php echo $reference_no;  ?></strong></h4></div>
                        <div class="date"><h5><strong>Delivery By: <?php echo $delivery_by;  ?></strong></h5></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>SR NO.</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">SIZE</th>
                            <th class="text-right">PRICE</th>
                            <th class="text-right">QUANTITY</th>
                            <th class="text-right">DISCOUNT</th>
                            
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                $fetch_product_details = "SELECT * FROM inventory_order_product WHERE order_id_foreign = '$order_id'";
                $Execute = mysqli_query($conn, $fetch_product_details);
                    $serial = 0;
                while ($row = mysqli_fetch_assoc($Execute)) {
                    $serial = $serial + 1;
                    $product_name = $row['product_name'];
                    $product_code = $row['product_code'];
                    $product_size = $row['product_size'];
                    $product_price = $row['product_price'];
                    $quantity = $row['quantity'];
                    $discount = $row['discount'];
                    $total = $row['total'];
                     ?>
                        <tr>
                            <td class="no"><?php echo "0"; echo  $serial;  ?></td>
                            <td class="text-left"><h3> <?php echo $product_code;  ?></h3>
                            <?php echo $product_name;  ?></td>
                            <td class="unit"><?php echo strtoupper($product_size);;  ?></td>
                           
                            <td class="unit">৳ <?php  echo $product_price;   ?></td>
                            <td class="unit"><?php echo $quantity;  ?></td>
                            <td class="tax"><?php echo $discount; ?>%</td>
                            <td class="total">৳ <?php echo $total; ?></td>
                        </tr>
                        <?php
                             }
                             ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="4">SUBTOTAL</td>
                            <td>৳<?php  echo $order_total - $shipping_charge;   ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="4">SHIPPING CHARGE</td>
                            <td>৳<?php  echo $shipping_charge;   ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="4" id='grand_total' >GRAND TOTAL</td>
                            <td>৳<?php  echo $order_total;   ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">System Generated Invoice.</div>
                </div>
            </main>
            <footer>
                Invoice was generated on a computer and is valid without the signature and seal.
            </footer>
        </div>
        
    </div>
</div>
     <!-- Print Invoice Script -->
     <script>
          $(document).ready(function(){
        //       $("#printInvoice").click(function(){
                
        //           $(".invoice").printThis({
        //             importCSS: true,
        //             loadCSS: "//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js",
        //             loadCSS: "css/invoice.css"
        //           });
        //       })
        //   })
        </script>


</body>
</html>