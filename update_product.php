<?php

        include 'connection.php';

    $product_id_update = $_POST['product_id_update'];
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];
    $product_price = $_POST['product_price'];
    $discount = $_POST['discount'];
    $special_price = $_POST['special_price'];
    $product_category = $_POST['product_category'];
    $total_stock = $_POST['total_stock'];

    
    $query = "UPDATE product SET category ='$product_category', product_name='$product_name', product_code='$product_code', product_stocks='$total_stock', product_price='$product_price', discount='$discount', special_price='$special_price' WHERE product_id = '$product_id_update' ";
    $Execute = mysqli_query($conn, $query);
    if ($Execute) {
        echo 'Done';
    } else {
        echo 'Cannot Update Stock';
    }
