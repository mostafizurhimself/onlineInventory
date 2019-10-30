<?php

include('database_connection.php');

$user_id = $_POST['user_id'];

$query = "DELETE FROM user_details WHERE user_id='$user_id'";

$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Done';
		}else{
            echo "Cannot delete!";
        }
