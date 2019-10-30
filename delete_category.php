<?php

include('database_connection.php');

$category_id = $_POST['category_id'];

$query = "DELETE FROM category WHERE category_id='$category_id'";

$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Done';
		}else{
            echo "Cannot delete!";
        }
