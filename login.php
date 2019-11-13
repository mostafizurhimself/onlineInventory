<?php
//login.php

include('database_connection.php');

if(isset($_SESSION['type']))
{
	header("location:index.php");
}

$message = '';

if(isset($_POST["login"]))
{
	$query = "
	SELECT * FROM user_details 
		WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
				'user_email'	=>	$_POST["user_email"]
			)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_status'] == 'Active')
			{
				if(password_verify($_POST["user_password"], $row["user_password"]))
				{
				
					$_SESSION['type'] = $row['user_type'];
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_name'] = $row['user_name'];
					header("location:index.php");
				}
				else
				{
					$message = "<label>Wrong Password</label>";
				}
			}
			else
			{
				$message = "<label>Your account is disabled, Contact Master</label>";
			}
		}
	}
	else
	{
		$message = "<label>Wrong Email Address</labe>";
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Online Inventory</title>	
		<link rel="icon"  sizes="20x20" type="image/ico" href="images/title_logo.png" />	
		<script src="js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container col-lg-4 col-lg-offset-4">
			<h2 align="center"> <strong>Online Inventory</strong> </h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading" align="center" > <h4> <strong>Log in with your email account</strong> </h4></div>
				<div class="panel-body">
					<form method="post">
						<?php echo $message; ?>
						<div class="form-group">
							<label>User Email</label>
							<input type="text" name="user_email" class="form-control" required placeholder="somebody@gmail.com" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="user_password" class="form-control" required placeholder="Password" />
						</div>
						<div class="form-group">
							<input type="submit" name="login" value="Login" class="btn btn-info btn-block" />
						</div>
						<div align='center' class="mt-3">
							<h4><strong>Email:</strong>999itsolution@gmail.com <strong>Password:</strong>mama@1234</h4>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>