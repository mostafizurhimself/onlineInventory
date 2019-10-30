<?php

 //fetch.php
 include_once 'connection.php';

 if (isset($_POST['product_id'])) {
     $query = "SELECT * FROM product WHERE product_id = '".$_POST['product_id']."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
     //  echo $row['product'];
 }