<?php

        include 'connection.php';


    $order_id = $_POST['order_id'];

    $customer_name = $_POST['customer_name'];

    $customer_mobile = $_POST['customer_mobile'];
    $customer_address = $_POST['customer_address'];
    $payment_method = $_POST['payment_method'];
    $order_from = $_POST['order_from'];
    $refrence_no = $_POST['refrence_no'];
    $order_total = $_POST['order_total'];
    $cod = $_POST['cod'];
    $courier_charge = $_POST['courier_charge'];
    $net_total= $order_total - $cod - $courier_charge;
    $payment_status = $_POST['payment_status'];
    $delivery_by = $_POST['delivery_by'];
    $remarks = $_POST['remarks'];
    $sale_status = 2;

    // if($payment_status == "Complete" ){
    //     $sql="UPDATE inventory_order_product SET sale_status = '$sale_status' WHERE order_id='$order_id'";
    //     $result= mysqli_query($conn, $sql);
    // }

    $query = "UPDATE inventory_order SET
              customer_name = '$customer_name', 
              customer_mobile = '$customer_mobile', 
              customer_address = '$customer_address', 
              payment_method = '$payment_method', 
              order_from = '$order_from', 
              reference_no = '$refrence_no', 
              courier_charge = '$courier_charge', 
              net_total = '$net_total', 
              payment_status = '$payment_status', 
              delivery_by = '$delivery_by', 
              remarks = '$remarks'    
              WHERE order_id='$order_id'";
    $Execute = mysqli_query($conn, $query);
    if ($Execute) {
        echo 'Done';
    } else {
        echo 'Cannot Update Stock';
    }
