<?php
include "connection.php";


$order_id = $_POST["invoice_no"];




$payment_status = "Returned";
$sale_status = 0;


$query1 = "UPDATE inventory_order SET payment_status='$payment_status' WHERE order_id='$order_id' " ;

$Execute1 = mysqli_query($conn, $query1);

$query2 = "UPDATE inventory_order_product SET sale_status='$sale_status' WHERE order_id_foreign='$order_id' " ;

$Execute2= mysqli_query($conn, $query2);



if($Execute2){
    echo "Done";
}else {
    echo "Undone";
}














?>
