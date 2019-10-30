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
        <div align="center" class="row col-lg-12"> <span class="h3"> <strong>Filter Product Report</strong> </span> </div>
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
                        <label>Product Code</label>
                        <select id="product_code" class="form-control" type="text"  >
                            <option selected disabled>Select Code</option>
                            <?php echo fill_product_code($connect);  ?>
                        </select>

                    </div> 
            </div>
            <div align="center" class="row col-lg-12">
                
                    <button id="search_product_report" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    <button id="print_product_report" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                    <button id="export_sale_report" type="button" class="btn btn-primary"><i class="fa fa-file"></i> Export</button>
            
            </div>
        
    </div>

    <div id="report_table">
    
    </div>


       
<script>
$(document).ready(function(){

    $('#print_product_report').click(function(){
        $('#report_table').printThis({
            importCSS: true,
            loadCSS: "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css",
        });
    })

    $("#search_product_report").click(function(){
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var product_code = $("#product_code").val();
     
       if(from_date == "" || to_date == ""){
           alert("Please enter a specific date range.")
       }else {
           $.ajax({
               url: "filter_product_report.php",
               method: "post",
               data: {from_date:from_date, 
               to_date:to_date, 
               product_code:product_code
                },
                success:function(data){
                    $("#report_table").html(data);
                }
           })

       }
    })
})

</script>
