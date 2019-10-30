<?php
//function.php
include('connection.php');

function get_total_pending($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$status = "Pending";
	$query = "SELECT SUM(order_total) AS total FROM inventory_order WHERE payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_total_complete($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$status = "Complete";
	$query = "SELECT SUM(order_total) AS total FROM inventory_order WHERE payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}
function get_total_hand_cash_pending($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "Hand Cash";
	$status = "Pending";
	$query = "SELECT SUM(order_total) AS total FROM inventory_order WHERE payment_method ='$payment_method' and payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}
function get_total_hand_cash_complete($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "Hand Cash";
	$status = "Complete";
	$query = "SELECT SUM(order_total) AS total FROM inventory_order WHERE payment_method ='$payment_method' and payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_total_cod_pending($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "COD";
	$status = "Pending";
	$query = "SELECT SUM(order_total) AS total FROM inventory_order WHERE payment_method ='$payment_method' and payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_total_cod_complete($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "COD";
	$status = "Complete";
	$query = "SELECT SUM(order_total) AS total FROM inventory_order WHERE payment_method ='$payment_method' and payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}
function get_total_bkash_pending($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "bKash";
	$status = "Pending";
	$query = "SELECT SUM(order_total) AS total_bkash_complete FROM inventory_order WHERE payment_method ='$payment_method' and payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total_bkash_complete'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_total_bkash_complete($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "bKash";
	$status = "Complete";
	$query = "SELECT SUM(order_total) AS total_bkash_complete FROM inventory_order WHERE payment_method ='$payment_method' and payment_status= '$status' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total_bkash_complete'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_total_grand_total_today($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");

	$query = "SELECT SUM(order_total) AS grand_total FROM inventory_order WHERE order_date ='$today'" ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['grand_total'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_total_hand_cash_today($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "Hand Cash";

	$query = "SELECT SUM(order_total) AS total_hand_cash FROM inventory_order WHERE order_date ='$today' and payment_method = '$payment_method' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total_hand_cash'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}


function get_total_cod_today($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "COD";

	$query = "SELECT SUM(order_total) AS total_cod FROM inventory_order WHERE order_date ='$today' and payment_method = '$payment_method' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total_cod'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}

function get_bKash_total_today($conn){
	date_default_timezone_set("Asia/Dhaka");
	$today = date("Y/m/d");
	$payment_method= "bKash";

	$query = "SELECT SUM(order_total) AS total_bKash FROM inventory_order WHERE order_date ='$today' and payment_method = '$payment_method' " ;
	$result = mysqli_query($conn, $query);
	$output = '';
	
	if (mysqli_num_rows($result) > 0 ){
		$row = mysqli_fetch_array($result);
		$output= $row['total_bKash'];
		if($output == null){
			$output = 0;
		}

	}else{
		$output = 0; 
	}
	return $output;
}



function get_total_order ($conn){
	$sql ="SELECT * FROM inventory_order";
	$result = mysqli_query($conn, $sql);
	$output = mysqli_num_rows($result);
	return $output;
}

function get_total_sale ($conn){
	$sql ="SELECT SUM(order_total) AS total_sale FROM inventory_order";
	$result = mysqli_query($conn, $sql);
	$output ="";

	while($row = mysqli_fetch_array($result)){
		$output .= $row['total_sale'] ;
	}

	return round($output);
}
function get_total_expense ($conn){
	$sql ="SELECT SUM(cod) AS total_cod, sum(courier_charge) as total_courier_charge FROM inventory_order";
	$result = mysqli_query($conn, $sql);
	$output ="";

	while($row = mysqli_fetch_array($result)){
		$total_cod = $row['total_cod'] ;
		$total_courier_charge = $row['total_courier_charge'] ;
		$output .= $total_cod + $total_courier_charge;
	}

	return round ($output);
}

function get_total_sale_quantity ($conn){
	$sql ="SELECT SUM(quantity) AS total_quantity FROM inventory_order_product WHERE sale_status = 1";
	$result = mysqli_query($conn, $sql);
	$output ="";

	while($row = mysqli_fetch_array($result)){
	
		$output .= $row['total_quantity'];
	}

	return round ($output);
}

// function get_remainging_stock ($conn, $product_code){
// 	$sql = "SELECT product_stocks FROM products WHERE product_code='$product_code' ";

// 	$result = mysqli_query($conn, $sql);
// 	$output ='';

// 	if(mysqli_num_rows($result) > 0){
// 		while($row = mysqli_fetch_array($result)){
// 		$output.=$row['product_stocks'];
// 		};
// 	return $output;
// 	};
// };

function get_last_order_id($conn)
{
	$sql = "SELECT order_id FROM inventory_order ORDER BY order_id DESC LIMIT 0, 1";
	$result = mysqli_query($conn, $sql);
	$output = "";
	if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= $row['order_id'];
            if ($output == null or $output == 0) {
                $output = 1;
            } else {
                $output = $output + 1;
            }
        }
    } else {
        $output = 1;
    }

    return $output;
}

function fill_category_list($connect)
{
	$query = "
	SELECT * FROM category 
	WHERE category_status = 'active' 
	ORDER BY category_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option>'.$row["category_name"].'</option>';
	}
	return $output;
}
function fill_product_code($connect)
{
	$query = "
	SELECT * FROM product 
	ORDER BY product_code ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option>'.$row["product_code"].'</option>';
	}
	return $output;
}


function get_user_name($connect, $user_id)
{
	$query = "
	SELECT user_name FROM user_details WHERE user_id = '".$user_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['user_name'];
	}
}

function fill_product_list($connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_status = 'active' 
	ORDER BY product_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["product_id"].'">'.$row["product_name"].'</option>';
	}
	return $output;
}

function fetch_product_details($product_id, $connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_id = '".$product_id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['product_name'] = $row["product_name"];
		$output['quantity'] = $row["product_quantity"];
		$output['price'] = $row['product_base_price'];
		$output['tax'] = $row['product_tax'];
	}
	return $output;
}

function available_product_quantity($connect, $product_id)
{
	$product_data = fetch_product_details($product_id, $connect);
	$query = "
	SELECT 	inventory_order_product.quantity FROM inventory_order_product 
	INNER JOIN inventory_order ON inventory_order.inventory_order_id = inventory_order_product.inventory_order_id
	WHERE inventory_order_product.product_id = '".$product_id."' AND
	inventory_order.inventory_order_status = 'active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = 0;
	foreach($result as $row)
	{
		$total = $total + $row['quantity'];
	}
	$available_quantity = intval($product_data['quantity']) - intval($total);
	if($available_quantity == 0)
	{
		$update_query = "
		UPDATE product SET 
		product_status = 'inactive' 
		WHERE product_id = '".$product_id."'
		";
		$statement = $connect->prepare($update_query);
		$statement->execute();
	}
	return $available_quantity;
}

function count_total_user($connect)
{
	$query = "
	SELECT * FROM user_details WHERE user_status='active'";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_category($connect)
{
	$query = "
	SELECT * FROM category WHERE category_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_brand($connect)
{
	$query = "
	SELECT * FROM brand WHERE brand_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_product($connect)
{
	$query = "
	SELECT * FROM product WHERE product_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_cash_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE payment_status = 'cash' 
	AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_credit_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order WHERE payment_status = 'credit' AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function get_user_wise_total_order($connect)
{
	$query = '
	SELECT sum(inventory_order.inventory_order_total) as order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "cash" THEN inventory_order.inventory_order_total ELSE 0 END) AS cash_order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "credit" THEN inventory_order.inventory_order_total ELSE 0 END) AS credit_order_total, 
	user_details.user_name 
	FROM inventory_order 
	INNER JOIN user_details ON user_details.user_id = inventory_order.user_id 
	WHERE inventory_order.inventory_order_status = "active" GROUP BY inventory_order.user_id
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>User Name</th>
				<th>Total Order Value</th>
				<th>Total Cash Order</th>
				<th>Total Credit Order</th>
			</tr>
	';

	$total_order = 0;
	$total_cash_order = 0;
	$total_credit_order = 0;
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row['user_name'].'</td>
			<td align="right">$ '.$row["order_total"].'</td>
			<td align="right">$ '.$row["cash_order_total"].'</td>
			<td align="right">$ '.$row["credit_order_total"].'</td>
		</tr>
		';

		$total_order = $total_order + $row["order_total"];
		$total_cash_order = $total_cash_order + $row["cash_order_total"];
		$total_credit_order = $total_credit_order + $row["credit_order_total"];
	}
	$output .= '
	<tr>
		<td align="right"><b>Total</b></td>
		<td align="right"><b>$ '.$total_order.'</b></td>
		<td align="right"><b>$ '.$total_cash_order.'</b></td>
		<td align="right"><b>$ '.$total_credit_order.'</b></td>
	</tr></table></div>
	';
	return $output;
}
// $product_code = "28JP";

// echo get_remainging_stock ($conn, $product_code);

// ?>