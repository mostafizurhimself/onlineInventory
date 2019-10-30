<?php 
 include 'connection.php';

 
 date_default_timezone_set("Asia/Dhaka");
 $order_date = date("Y/m/d");
 $customer_name = $_POST['customer_name'];
 $customer_mobile = $_POST['customer_mobile'];
 $customer_address = $_POST['customer_address'];
 $payment_method = $_POST['payment_method'];
 $order_from = $_POST['order_from'];
 $refrence_no = $_POST['refrence_no'];
 $shipping_charge = $_POST['shipping_charge'];
 $order_total = $_POST['order_total'];
 $cod = $_POST['cod'];
 $courier_charge = $_POST['courier_charge'];
 $net_total = $order_total - $cod - $courier_charge;
 $payment_status = $_POST['payment_status'];
 $delivery_by = $_POST['delivery_by'];
 $remarks = $_POST['remarks'];

  $query = "INSERT INTO inventory_order(order_date, customer_name, customer_mobile, customer_address, payment_method, order_from, reference_no, shipping_charge, order_total, cod, courier_charge,net_total, payment_status, delivery_by, remarks)  
 VALUES ('$order_date', '$customer_name', '$customer_mobile', '$customer_address', '$payment_method', '$order_from', '$refrence_no', '$shipping_charge', '$order_total','$cod','$courier_charge', '$net_total','$payment_status', '$delivery_by', '$remarks')";
$Execute = mysqli_query($conn, $query);   

 if(isset($_POST["product_code"]))
 {
      $order_id = $_POST['order_id'];
      $product_code = $_POST['product_code'];
      $product_name = $_POST['product_name'];
      $product_quantity = $_POST['product_quantity'];
      $product_size = $_POST['product_size'];
      $product_price = $_POST['product_price'];
      $discount = $_POST['discount'];
      $total = $_POST['total'];

      $length = count($product_code);

  $query = '';
  for($count = 0; $count<$length; $count++)
  {
   $order_id = mysqli_real_escape_string($conn, $order_id);
   $order_date = mysqli_real_escape_string($conn, $order_date);
   $product_code_clean = mysqli_real_escape_string($conn, $product_code[$count]);
   $product_name_clean = mysqli_real_escape_string($conn, $product_name[$count]);
   $product_quantity_clean = mysqli_real_escape_string($conn, $product_quantity[$count]);
   $product_size_clean = mysqli_real_escape_string($conn, $product_size[$count]);
   $product_price_clean = mysqli_real_escape_string($conn, $product_price[$count]);
   $discount_clean = mysqli_real_escape_string($conn, $discount[$count]);
   $total_clean = mysqli_real_escape_string($conn, $total[$count]);

   if($product_code_clean != '')
   {
	$query .= '
	INSERT INTO inventory_order_product(order_id_foreign, sale_date, product_code, product_name, product_size, quantity, product_price, discount, total) 
	VALUES("'.$order_id.'","'.$order_date.'","'.$product_code_clean.'","'.$product_name_clean.'", "'.$product_size_clean.'", "'.$product_quantity_clean.'", "'.$product_price_clean.'", "'.$discount_clean.'", "'.$total_clean.'"); 
   ';
  
   }
  }
  if($query != '')
  {
   if(mysqli_multi_query($conn, $query))
   {
   echo 'Done';
   }
   else
   {
	echo mysqli_error($conn);;
   }
  }
  else
  {
   echo 'All Fields are Required';
  }
 }


















?>