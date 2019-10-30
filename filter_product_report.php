<?php
include 'connection.php';

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$product_code = $_POST['product_code'];

$output = '';
$query = "SELECT * FROM inventory_order_product WHERE sale_date BETWEEN '$from_date' AND '$to_date' " ;
$query2 = "SELECT SUM(quantity) AS total_quantity, SUM(total) AS total FROM inventory_order_product WHERE sale_date BETWEEN '$from_date' AND '$to_date'";


if(!empty($product_code)){

    $query .= "AND product_code = '$product_code'";
    $query2 .= "AND product_code = '$product_code'";
   
}


$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);

$output .= '
            <div align="center" style="margin-bottom: 20px; margin-top: 50px;">
                <span style="font-size:22px;"><strong>Easy Fashion Online Shop Sale Report</strong> </span>
                <div><strong>From Date: '.$from_date.'</span> <span><span></span>To Date: '.$to_date.'</strong></div>
            </div>
            
           <table style="font-size: 12px;" class="table table-bordered">  
                <tr>  
                    <th>Id</th> 
                    <th>Date</th> 
                    <th>Product Name</th>  
                     <th>Code</th> 
                     <th>Price</th>                
                     <th>Discount</th>   
                     <th>Size</th>  
                     <th d class="text-right">Quantity</th>  
                     <th  class="text-right">Total</th>     
                </tr>  
      ';
     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_array($result)) {
             $output .= '  
                     <tr>  
                          <td>'.$row['order_id_foreign'].'</td>
                          <td>'.$row['sale_date'].'</td>
                          <td>'.$row['product_name'].'</td>  
                          <td>'.$row['product_code'].'</td>  
                          <td>'.$row['product_price'].'</td>    
                          <td>'.$row['discount'].'</td>  
                          <td>'.$row['product_size'].'</td>  
                          <td class="text-right" >'.$row['quantity'].'</td>  
                          <td class="text-right" >৳ '.$row['total'].'</td> 
           
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
                        <td class="text-center" colspan="7"><strong>Total</strong></td>   
                        <td class="text-right"><strong>'.$row['total_quantity'].'</strong></td>  
                        <td class="text-right"><strong>৳'.$row['total'].'</strong></td> 
                       
                   </tr>  
              ';
        }
    }

     $output .= '</table>';
     echo $output;
 


?>