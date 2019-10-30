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
        <span id='alert_action'></span>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            	<h3 class="panel-title">Product List</h3>
                            </div>
                        
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='right'>
                                <button type="button" name="add" id="add_product" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i> Add</button>
                                <!-- <button type="button" name="add" id="print_stock" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i> Add</button> -->
                                <a class="btn btn-info btn-sm" href="product_report.php"><i class="fas fa-chart-bar"></i> Report</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="product_data" class="table table-bordered table-striped">
                                    <thead><tr>
                                        <th>ID</th>                                   
                                        <th>Product Name</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Discount %</th>
                                        <th>Special Price</th>
                                        <th>Stocks</th>
                                        <th>Sale</th>
                                        <!-- <th>Return</th> -->
                                        <th>Remaining</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr></thead>
                                    <tbody>
                                    <?php
                                    $fetch_purchase_item_query = 'SELECT * FROM product ORDER BY product_name';
                                    $Execute = mysqli_query($conn, $fetch_purchase_item_query);
                                        $serial = 0;
                                    while ($row = mysqli_fetch_assoc($Execute)) {
                                        $serial = $serial + 1;
                                        $productId = $row['product_id'];
                                        $productName = $row['product_name'];
                                        $productCode = $row['product_code'];
                                        $productStocks = $row['product_stocks'];
                                        $productReturns = $row['product_returns'];
                                        $productPrice = $row['product_price'];
                                        $discount = $row['discount'];
                                        $special_price = $row['special_price'];
                                        $productCategory = $row['category'];
                                        $purchaseItemStock = $row['product_stocks'];
                                    $query = "SELECT SUM(quantity) AS Quantity FROM inventory_order_product WHERE product_code = '$productCode' AND sale_status=1";
                                    $result = mysqli_query($conn, $query);

                                    while($data = mysqli_fetch_assoc($result)){
                                           $sale_quantity = $data['Quantity'];
                                           
                                     ?>
                                        
                                    <tr>
                                    <td><?php  echo $serial; ?></td>
                                    <td><?php  echo $productName; ?></td>
                                    <td><?php  echo $productCode; ?></td>
                                    <td><?php  echo $productCategory; ?></td>
                                    <td><?php  echo $productPrice; ?></td>
                                    <td><?php  echo $discount; ?></td>
                                    <td><?php  echo $special_price; ?></td>
                                    <td><?php  echo $productStocks.' pcs'; ?></td>
                                    <td><?php  echo $sale_quantity.' pcs'; ?></td>
                                    <!-- <td><?php  // echo $productReturns.' pcs'; ?></td> -->
                                    <td><?php  echo $productStocks-$sale_quantity.' pcs'; ?></td>
                                    <td><button id="<?php echo $productId; ?>" name="update_product" class="btn btn-sm btn-primary update_product"><i class="fas fa-edit"></i> Update</button>
                                    <div class="modal fade" id="update_product_modal" >
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-edit"></i> Update Product</h4>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <label>Product Name</label>  
                                                <input type="text" name="product_name_update" id="product_name_update" class="form-control"  /> 
                                                <br> 
                                                <label>Product Code</label>  
                                                <input type="text" name="product_code_update" id="product_code_update" class="form-control"  /> 
                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Product Price</label>  
                                                            <input type="number" name="product_price_update" id="product_price_update" class="form-control" value=0  /> 
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Discount</label>  
                                                            <input type="number" name="discount_update" id="discount_update" class="form-control" value=0 />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Sepcial Price</label>  
                                                            <input type="number" name="special_price_update" id="special_price_update" class="form-control" value=0  />
                                                        </div>
                                                    </div>
                                                </div> 
                                        
                                                   
                                                <label>Category</label>  
                                                <select class="form-control" name="product_category_update" id="product_category_update">
                                                    <option disabled selected>Select Category</option>
                                                    <?php echo fill_category_list($connect); ?>
                                                </select>
                                                <br> 
                                                <div class="row" >
                                                    <div class=" col-lg-4">
                                                        <label>Remaining Stock</label>  
                                                        <input type="number" name="product_remaining_stock" id="product_remaining_stock" class="form-control" value="0" readonly /> 
                                                    </div>
                                                    <div class=" col-lg-4">
                                                        <label>Add Stock</label>  
                                                        <input type="number" name="add_stock" id="add_stock" class="form-control" value="0" /> 
                                                    </div>
                                                    <div class=" col-lg-4">
                                                        <label>Total Stock</label>  
                                                        <input type="number" name="total_stock" id="total_stock" class="form-control" value="0" readonly /> 
                                                    </div>
                                                </div>
                                                <br>
                                                <input type="hidden" name="product_id_update" id="product_id_update" value="" />      
                                            </div>
                                            <div class="modal-footer">
                                            <input type="button" name="update_product" id="update_product" value="Save" class="btn btn-primary" /> 
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                    
                    
                    
                                            </td>  
                                     <td><button id="<?php echo $productId; ?>"  name="delete" class="btn btn-sm btn-danger delete_product" > <i class="fas fa-trash-alt"></i> Delete</button></td>
                                            </tr>
                                        <?php
                                        }    }
                                        ?>
                                            </tbody>

                                    <tfoot>
                                        <?php 
                                        
                                        $query2 = "SELECT SUM(product_stocks) AS total_product_stock, SUM(product_returns) AS total_return FROM product";
                                        $query3 = "SELECT SUM(quantity) AS total_sale_quantity FROM inventory_order_product";
                                        $result2 = mysqli_query($conn, $query2);
                                        $result3 = mysqli_query($conn, $query3);
                                            while ($row = mysqli_fetch_array($result2)) {
                                                $row2 = mysqli_fetch_array($result3)

                                             ?> 
                                                       <tr>  
                                                            <td class="text-right" colspan="7"><strong>Total</strong></td>   
                                                            <td class="text-right"><strong> <?php echo $row['total_product_stock']; ?> pcs</strong></td>  
                                                            <td class="text-center"><strong> <?php echo $row2['total_sale_quantity'] ; ?> pcs</strong></td> 
                                                            <td class="text-center"><strong> <?php echo $row['total_product_stock']-$row2['total_sale_quantity'] ; ?> pcs</strong></td> 
                                                            <td></td>
                                                            <td></td>

                                                           
                                                       </tr>  
                                          <?php      
                                            }
                                        
                                        ?>
                                    
                                    </tfoot>


                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                             <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label>Product Name</label>  
                                            <input  type="text" name="product_name" id="product_name" class="form-control"  /> 
                                            <br> 
                                            <label>Product Code</label>  
                                            <input  type="text" name="product_code" id="product_code" class="form-control"  /> 
                                            <br> 
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Product Price</label>  
                                                        <input type="number" name="product_price" id="product_price" class="form-control" value=0  /> 
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Discount</label>  
                                                        <input type="number" name="discount" id="discount" class="form-control" value=0 />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Sepcial Price</label>  
                                                        <input type="number" name="special_price" id="special_price" class="form-control" value=0  />
                                                    </div>
                                                </div>
                                            </div> 
                                            <label>Category</label>  
                                            <select class="form-control" name="product_category" id="product_category">
                                                <option disabled selected>Select Category</option>
                                                    <?php echo fill_category_list($connect); ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="save_product" class="btn btn-primary">Save</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                                            
                    </div>
			    </div>
		    </div>
        </div>

        


<script>
$(document).ready(function(){

$('#product_code').keyup(function() {
    this.value = this.value.toUpperCase();
});
$('#product_code_update').keyup(function() {
    this.value = this.value.toUpperCase();
});

function calculate_total(){
    var remaining_stock = parseInt($("#product_remaining_stock").val() || 0);
    var add_stock = parseInt($("#add_stock").val()|| 0);
    var result = remaining_stock + add_stock;
    $("#total_stock").val(result);
}

calculate_total();

function calculate(){
    var product_price=parseInt( $("#product_price").val());
    var discount=parseInt( $("#discount").val());
    var total_discount = product_price *(discount/100);
    var special_price = product_price-total_discount;
    $("#special_price").val(special_price);
}

$('#product_price').keyup(function(){
    calculate();
})

$('#discount').keyup(function(){
    calculate();
})
$('#discount_update').keyup(function(){
    var product_price=parseInt( $("#product_price_update").val());
    var discount=parseInt( $("#discount_update").val());
    var total_discount = product_price *(discount/100);
    var special_price = product_price-total_discount;
    $("#special_price_update").val(special_price);
})
$('#product_price_update').keyup(function(){
    var product_price=parseInt( $("#product_price_update").val());
    var discount=parseInt( $("#discount_update").val());
    var total_discount = product_price *(discount/100);
    var special_price = product_price-total_discount;
    $("#special_price_update").val(special_price);
})
//calculate Function
$(document).on("keyup", "#add_stock", function(){
    var remaining_stock = parseInt($("#product_remaining_stock").val() || 0);
    var add_stock = parseInt($("#add_stock").val()|| 0);
    var result = remaining_stock + add_stock;
    $("#total_stock").val(result);
})
// Add Product
$(document).on("click","#add_product", function(){
    $("#add_product_modal").modal('show');
})
// Save product
$(document).on("click","#save_product", function(){
    var product_name= $('#product_name').val();
    var product_code= $('#product_code').val();
    var product_price= $('#product_price').val();
    var discount = $('#discount').val();
    var special_price = $('#special_price').val();
    var product_category= $('#product_category').val();
    var total_stock= $('#product_total_stock').val();

    if(product_name == ""){
      alert("Product name is required!")
    }else if (product_code=="") {
      alert("Product code is required!")
    }else if (product_price == "") {
      alert("Product price is required!")
    } else if (product_category == "") {
      alert("Product category is required!")
    }else{
        $.ajax ({
            url: 'insert_product.php',
            method: "POST",
            data: {product_name:product_name, product_code:product_code, product_price:product_price,discount:discount, special_price:special_price, product_category:product_category},
            success: function(data){
              if(data=="Done"){
                Swal({
                        title: 'Product Added Successfully',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.value) {
                           window.location.reload();
                        }
                      })
                 
                }
                else if(data=="Code Exists"){
                    Swal({
                        type: 'error',
                        title: 'Product Code Already Exists....!',
                        confirmButtonColor: "#f8173c"
                      })
                }
                else{

                    Swal({
                        type: 'error',
                        title: 'Cannot Insert Product....!',
                        confirmButtonColor: "#f8173c"
                      })

                }
              }
        }); 
    }
})
// Update Product
$(document).on("click",".update_product", function(){
    // $("#update_product_modal").modal('show');
    var product_id = $(this).attr("id");
    $.ajax({  
                url:"fetch_product.php",  
                method:"POST",  
                data:{product_id:product_id},  
                dataType:"json",  
                success:function(data){  
                  // alert(data);
                     $('#product_name_update').val(data.product_name);  
                     $('#product_code_update').val(data.product_code); 
                     $('#product_price_update').val(data.product_price);
                     $('#discount_update').val(data.discount);
                     $('#special_price_update').val(data.special_price);
                     $('#product_category_update').val(data.category);
                     $('#product_id_update').val(data.product_id);   
                     $('#product_remaining_stock').val(data.product_stocks);  
                    //  $('#product_total_stock').val(data.product_stock); 
                     $("#update_product_modal").modal('show');  
                     calculate_total();
                }  
           });
})

$(document).on("click","#update_product", function(){
    var product_id_update = $("#product_id_update").val();
    var product_name=$("#product_name_update").val();
    var product_code=$("#product_code_update").val();
    var product_price=$("#product_price_update").val();
    var discount = $('#discount_update').val();
    var special_price = $('#special_price_update').val();
    var product_category=$("#product_category_update").val();
    var total_stock = $("#total_stock").val();
    
    $.ajax({  
                url:"update_product.php",  
                method:"POST",  
                data:{product_id_update:product_id_update, product_name:product_name, product_code:product_code, product_price:product_price, discount:discount, special_price:special_price, product_category:product_category, total_stock:total_stock},   
                success:function(data){  
                  if (data=="Done") {
                    Swal({
                        title: 'Product Updated Successfully!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.value) {
                           window.location.reload();
                        }
                      })  
                  }
                  else {
                    Swal({
                        type: 'error',
                        title: 'Cannot update stock....!',
                        confirmButtonColor: "#f8173c"
                      })
                  }
               
                }  
           });
})

$(document).on('click','.delete_product', function(){
    var product_id = $(this).attr("id");
    Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                url: "delete_product.php",
                method: "POST",
                data:{product_id:product_id },
                success: function(data){
                  if (data=="Done") {
                    Swal({
                        title: 'Product Deleted Successfully!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.value) {
                           window.location.reload();
                        }
                      })  
                  }
                }
            })
          }
        })
})

// $("#product_data").dataTable();

});
</script>
