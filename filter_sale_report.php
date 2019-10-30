<?php
include 'connection.php';

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$payment_status = $_POST['payment_status'];
$payment_method = $_POST['payment_method'];
$order_from = $_POST['order_from'];
$delivery_by = $_POST['delivery_by'];
$output = '';
$query = "SELECT * FROM inventory_order WHERE order_date BETWEEN '$from_date' AND '$to_date' " ;
$query2 = "SELECT SUM(order_total) AS total_order_amount, SUM(cod) AS total_cod, SUM(courier_charge) AS total_courier_charge, SUM(net_total) AS total_net_total FROM inventory_order WHERE order_date BETWEEN '$from_date' AND '$to_date'";
 



if(!empty($payment_status)){

    $query .= "AND payment_status = '$payment_status'";
    $query2 .= "AND payment_status = '$payment_status'";
   
}
if(!empty($payment_method)){
    $query .= "AND payment_method = '$payment_method'";
    $query2 .= "AND payment_method = '$payment_method'";
}
if(!empty($order_from)){
    $query .= "AND order_from = '$order_from'";
    $query2 .= "AND order_from = '$order_from'";
}
if(!empty($delivery_by)){
    $query .= "AND delivery_by = '$delivery_by'";
    $query2 .= "AND delivery_by = '$delivery_by'";
}
$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);

$output .= '
            <div align="center" style="margin-bottom: 20px;">
                <span style="font-size:22px;"><strong>Easy Fashion Online Shop Sale Report</strong> </span>
                <div><strong>From Date: '.$from_date.'</span> <span><span></span>To Date: '.$to_date.'</strong></div>
            </div>
            
           <table id="x-editable" style="font-size: 12px;" class="table table-bordered">  
                <tr>  
                    <th>Id</th> 
                    <th width="10%">Date</th> 
                     <th width="10%">Customer Name</th>  
                     <th width="10%">Customer Mobile</th>  
                     <th width="15%">Address</th>  
                     <th  width="5%">Payment Method</th>  
                     <th width="5%" >Order From</th>  
                     <th>RN</th>  
                     <th  width="5%" class="text-center">Payment Status</th> 
                     <th  width="5%" class="text-center">Delivery By</th> 
                     <th width="10%" class="text-right" >Order Total</th>  
                     <th width="7%" class="text-right" >COD</th> 
                     <th width="7%" class="text-right" >Courier Charge</th> 
                     <th width="10%" class="text-right" >Net Total</th> 
                     
                </tr>  
      ';
     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_array($result)) {
             $output .= '  
                     <tr>  
                          <td>'.$row['order_id'].'</td>
                          <td>'.$row['order_date'].'</td>
                          <td>'.$row['customer_name'].'</td>  
                          <td>'.$row['customer_mobile'].'</td>  
                          <td>'.$row['customer_address'].'</td>    
                          <td>'.$row['payment_method'].'</td>  
                          <td>'.$row['order_from'].'</td>  
                          <td>'.$row['reference_no'].'</td>  
                          <td class="text-center">'.$row['payment_status'].'</td>  
                          <td class="text-center">'.$row['delivery_by'].'</td>  
                          <td class="text-right" >৳ '.$row['order_total'].'</td> 
                          <td class="text-right" >৳ '.$row['cod'].'</td> 
                          <td class="text-right" >৳ '.$row['courier_charge'].'</td> 
                          <td class="text-right" >৳ '.$row['net_total'].'</td> 
           
                     </tr> 
                     <tr>
                     </tr> 
                ';
         }
     } else {
         $output .= '  
                <tr>  
                     <td colspan="9" class="text-center">No Result Found</td>  
                </tr>  
           ';
     }
     if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            $output .= '  
                   <tr>  
                        <td class="text-right" colspan="10"><strong>Total Order</strong></td>   
                        <td class="text-right"><strong>৳ '.$row['total_order_amount'].'</strong></td>  
                        <td class="text-right"><strong>৳ '.$row['total_cod'].'</strong></td>  
                        <td class="text-right"><strong>৳ '.$row['total_courier_charge'].'</strong></td>  
                        <td class="text-right"><strong>৳ '.$row['total_net_total'].'</strong></td>  
                       
                   </tr>  
              ';
        }
    }

     $output .= '</table>';
     echo $output;
    

?>

<script>

$("#x-editable").DataTable();

</script>