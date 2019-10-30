<?php
//product.php

include('database_connection.php');
include('connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
    header('location:login.php');
}

if($_SESSION['type'] != 'master')
{
    header('location:index.php');
}

include('header.php');


?>  
    <div >
        <div align="center" class="row col-lg-12"> <span class="h3"> <strong>Filter Sales Report</strong> </span> </div>
            <div class="row">
                    <div class="form-group col-lg-4">
                        <label>From</label>
                        <input id="from_date" class="form-control" type="date"  >

                    </div>
                    <div class="form-group col-lg-4">
                        <label>To</label>
                        <input id="to_date" class="form-control" type="date"  >

                    </div>
                    <div class="form-group col-lg-4">
                        <label>Payment Status</label>
                        <select id="payment_status" class="form-control" type="text"  >
                            <option selected disabled>Select Status</option>
                            <option>Complete</option>
                            <option>Pending</option>
                            <option>Returned</option>
                        </select>

                    </div>    
            </div>
            <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Payment Method</label>
                        <select id="payment_method" class="form-control" type="text"  >
                            <option selected disabled>Select Method</option>
                            <option>COD</option>
                            <option>bKash</option>
                            <option>Hand Cash</option>
                        </select>
                    </div>    
                    <div class="form-group col-lg-4">
                        <label>Order From</label>
                        <select id="order_from" class="form-control" type="text"  >
                            <option selected disabled>Select One</option>
                            <option>Online</option>
                            <option>Facebook</option>
                        </select>

                    </div>
                    <div class="form-group col-lg-4">
                        <label>Delivery By</label>
                        <select id="delivery_by" class="form-control" type="text"  >
                            <option selected disabled>Select One</option>
                            <option>Pathao</option>
                            <option>Showroom</option>
                            <option>Emergency</option>
                        </select>

                    </div>
                  
            </div>
            <div align="center" class="row col-lg-12">
                
                    <button id="search_sale_report" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    <button id="print_sale_report" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                    <button id="export_sale_report" type="button" class="btn btn-primary"><i class="fa fa-file"></i> Export</button>
            
            </div>
        
    </div>

    <div style="margin-top: 70px;"  id="report_table">
    
    </div>


       
<script>
$(document).ready(function(){
    $('#print_sale_report').click(function(){
        $('#report_table').printThis({
            importCSS: true,
            // loadCSS: "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css",
        });
    })

    $("#search_sale_report").click(function(){
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var payment_status = $("#payment_status").val();
        var payment_method = $("#payment_method").val();
        var order_from = $("#order_from").val();
        var delivery_by = $("#delivery_by").val();
       
     
       if(from_date == "" || to_date == ""){
           alert("Please enter a specific date range.")
       }else {
           $.ajax({
               url: "filter_sale_report.php",
               method: "post",
               data: {from_date:from_date, 
               to_date:to_date, 
               payment_status:payment_status, 
               payment_method:payment_method, 
               order_from:order_from,
               delivery_by:delivery_by
                },
                success:function(data){
                    $('#report_table').html(data);
                }
           })

       }
    })
})

</script>
