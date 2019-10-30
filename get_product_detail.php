<?php

// Get Product Details
 include_once 'connection.php';

 if (isset($_POST['product_code'])) {
     $query = "SELECT * FROM product WHERE product_code = '".$_POST['product_code']."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
 }
