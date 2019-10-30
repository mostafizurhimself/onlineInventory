<?php
include ("connection.php");

$order_id = $_POST['order_id'];
$sql = "SELECT * FROM inventory_order WHERE order_id = '$order_id' ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo json_encode($row);




?>