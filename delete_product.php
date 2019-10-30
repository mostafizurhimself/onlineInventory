<?php

include('database_connection.php');

$product_id = $_POST['product_id'];

$query = "DELETE FROM product WHERE product_id='$product_id'";

$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Done';
		}else{
            echo "Cannot delete!";
        }
