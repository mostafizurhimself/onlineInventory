<?php
//header.php
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Online Inventory</title>

		
		<link rel="icon"  sizes="20x20" type="image/ico" href="images/title_logo.png" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="vendors/SweetAlert2/package/dist/sweetalert2.min.css" />
		<link rel="stylesheet" href="vendors/select2/dist/css/select2.min.css" />
		<link rel="stylesheet" href="vendors/dataTable/datatables.min.css" />
		<link rel="stylesheet" href="vendors/morris.js/morris.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">


		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="vendors/dropdownFilter/ddtf.js"></script>

		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>	
			

		
		<script src="js/bootstrap.min.js"></script>
		<script src="vendors/SweetAlert2/package/dist/sweetalert2.min.js"></script>
		<script src="vendors/select2/dist/js/select2.full.min.js"></script>
		<script src="vendors/dataTable/datatables.min.js"></script>
		<script src="vendors/printThis/printThis.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  		<script src="vendors/morris.js/morris.min.js"></script>

	



		<style>
			.active {
				background-color: #022f5a;
				color: white;
			}
		</style>
		<script>
		jQuery(document).ready(function($){
				// Get current path and find target link
				var path = window.location.pathname.split("/").pop();
				
				// Account for home page with empty path
				if ( path == '' ) {
					path = 'index.php';
				}
					
				var target = $('nav a[href="'+path+'"]');
				// Add active class to target link
				target.addClass('active');
		
				});
		</script>

	
	</head>
	<body>
		<br />
		<div class="container">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand link"> <i class="fa fa-home" aria-hidden="true"></i> Home</a>
					</div>
					<ul class="nav navbar-nav">
					<?php
					if($_SESSION['type'] == 'master')
					{
					?>
						<li><a href="user.php"> <i class="fa fa-users link" aria-hidden="true"></i> Users</a></li>
					
						
					<?php
					}
					?>
						<li><a href="category.php"><i class="fa fa-list-ul link" aria-hidden="true"></i> Category</a></li>
						<li><a href="product.php"><i class="fa fa-cubes link" aria-hidden="true"></i> Product</a></li>
						<li><a href="order.php"><i class="fa fa-shopping-basket link" aria-hidden="true"></i> Order</a></li>
						<li><a href="sale_report.php"><i class="fas fa-chart-bar"></i> Report</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown link">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span><i class="fas fa-user-circle"></i>  <?php echo $_SESSION["user_name"]; ?></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php"><i class="fas fa-address-card"></i> Profile</a></li>
								<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</nav>
			