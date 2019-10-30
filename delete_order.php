<?php

include('connection.php');

$order_id = $_POST['order_id'];

$query = "DELETE FROM inventory_order WHERE order_id='$order_id'";
$query2 = "DELETE FROM inventory_order_product WHERE order_id_foreign='$order_id'";
$result = mysqli_query($conn, $query); 
$result2 = mysqli_query($conn, $query2); 

if($result){
    echo "Done";
}else{
    echo "Error";
};

