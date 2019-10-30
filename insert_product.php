<?php

        include 'connection.php';
 
 
         $product_name= mysqli_real_escape_string($conn, $_POST['product_name']);
         
         $product_code= mysqli_real_escape_string($conn, $_POST['product_code']);
         
         $product_price= mysqli_real_escape_string($conn, $_POST['product_price']);
         $discount= mysqli_real_escape_string($conn, $_POST['discount']);
         $special_price= mysqli_real_escape_string($conn, $_POST['special_price']);
         
         $product_category=mysqli_real_escape_string($conn, $_POST['product_category']);

         $sql= "SELECT * FROM product WHERE product_code = '$product_code'";
         $result = mysqli_query($conn,$sql);
         if(mysqli_num_rows($result)>0){
            echo "Code Exists";
         }else{
            $query = "INSERT INTO product (product_name, product_code, product_price, discount, special_price, category)
            VALUES ('$product_name', '$product_code', '$product_price','$discount','$special_price', '$product_category')";
            $Execute = mysqli_query($conn, $query);
            if ($Execute) {
                echo 'Done';
            } else {
                echo 'Cannot Insert Product';
            }
         }


         