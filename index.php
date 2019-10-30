<?php
//index.php
include('database_connection.php');
include('connection.php');
include('function.php');
$page='home';

if(!isset($_SESSION["type"]))
{
	header("location:login.php");
}

include('header.php');


$query = "SELECT order_date, SUM(order_total) as order_total FROM inventory_order WHERE MONTH(CURDATE())=MONTH(order_date) GROUP BY order_date";
$result = mysqli_query($conn, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ day:'".$row["order_date"]."', total:".$row["order_total"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);

?>
	<br />
	
<div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-shopping-cart"></i>
        <span class="count-numbers"><?php echo get_total_order($conn);  ?></span>
        <span class="count-name">Total Order</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-inbox"></i>
        <span class="count-numbers"><?php echo get_total_sale ($conn) ;   ?></span>
        <span class="count-name">Total Sale</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fa fa-truck"></i>
        <span class="count-numbers"><?php  echo get_total_expense ($conn);   ?></span>
        <span class="count-name">Charges</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-cubes"></i>
        <span class="count-numbers"><?php echo get_total_sale_quantity ($conn);  ?></span>
        <span class="count-name">Product Sale</span>
      </div>
    </div>
</div>
<br>

<div class="row">
   <div class="col-lg-12">
    <div align="center" style="font-size: 22px; font-weight: bold;"> 
      <span >Monthly Sale Graph</span>
    </div>
    <div id="chart" >
            </div>
   </div>
        
</div>

<br>
<br>
<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                            <div class="col-lg-6">
                            	<h3 class="panel-title"><strong>Today's Earnings</strong></h3>
                            </div>
                        
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table id="product_data" class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="table-primary">                               
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                    </tr></thead>
                                    <tbody>
    
                                    <tr>
                                    <td>bKash</td>
                                    <td> <?php echo get_bKash_total_today($conn);   ?> ৳</td> 
                                     </tr>
                                     <tr>
                                    <td>Pathao</td>
                                    <td><?php echo get_total_cod_today($conn);   ?> ৳ </td> 
                                     </tr>
                                     <tr>
                                    <td>Hand Cash</td>
                                    <td><?php echo get_total_hand_cash_today($conn);   ?> ৳</td> 
                                     </tr>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                          <td> <strong>Grand Total</strong> </td>
                                          <td><?php echo get_total_grand_total_today($conn);   ?> ৳</td>
                                        </tr>
                                    </tfoot>


                                </table>
                            </div>
                        </div>
                    </div>
			    </div>
		    </div>
        <div class="col-lg-6">





</div>


<div class="row">
  <div class="col-lg-6">
           
  <div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                            <div class="col-lg-6">
                            	<h3 class="panel-title"><strong>Net Earnings</strong></h3>
                            </div>
                        
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table id="product_data" class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="table-primary">                               
                                        <th>Payment Method</th>
                                        <th>Complete</th>
                                        <th>Pending</th>
                                    </tr></thead>
                                    <tbody>
    
                                    <tr>
                                    <td>bKash</td>
                                    <td> <?php echo get_total_bkash_complete($conn);   ?> ৳</td> 
                                    <td><?php echo get_total_bkash_pending($conn);  ?>৳</td>
                                     </tr>
                                     <tr>
                                    <td>Pathao</td>
                                    <td><?php echo get_total_cod_complete($conn);   ?> ৳ </td> 
                                    <td><?php echo get_total_cod_pending($conn) ;?>৳</td>
                                     </tr>
                                     <tr>
                                    <td>Hand Cash</td>
                                    <td><?php echo get_total_hand_cash_complete($conn);   ?> ৳</td> 
                                    <td><?php echo get_total_hand_cash_pending($conn);     ?>৳</td>
                                     </tr>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                          <td> <strong>Grand Total</strong> </td>
                                          <td><?php echo get_total_complete($conn);   ?> ৳</td>
                                          <td><?php echo  get_total_pending($conn);     ?>৳</td>
                                        </tr>
                                    </tfoot>


                                </table>
                            </div>
                        </div>
                    </div>
			    </div>

  </div>

</div>

<script>
				Morris.Bar({
				element : 'chart',
				data:[<?php echo $chart_data; ?>],
				xkey:'day',
				ykeys:['total'],
				labels:['total'],
				hideHover:'auto',
				stacked:false
				});
</script>

<?php
include("footer.php");
?>