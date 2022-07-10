<!DOCTYPE html>
<html lang="en">
<?php 
	require('./PHP/connection.php');
	session_start();
	require('./PHP/common_files.php');
	if(!isset($_SESSION['userid'])){
        echo "<script> location.href='./login.php'; </script>";
    }
 ?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Your Products</title>
</head>
<body>
	<?php 
		require('./PHP/header.php');
		include("./PHP/error.php");
	 ?>
   <div class="mid">
        <!-- <div class="container-box"> -->
            <!-- Order DB -->
            <h2 class="ms-3">Orders for your Products</h2>
            
            <div class="products">
                
                <div class="container">
                    <!-- First -->
                    <?php
                        if(!isset($_SESSION['userid'])){
                            echo "<script> location.href='./login.php'; </script>";
                            exit;
                        }
                        $orderQuery = "SELECT `Product_ID` FROM `order_table` WHERE `Seller_ID`='".$_SESSION["userid"]."'";
                        $orderResult=mysqli_query($connection,$orderQuery) or die('Invalid query:');
                        if(mysqli_num_rows($orderResult)<1){
                          echo"People haven't ordered your products till now!";
                        }else{
                          while($orderRow = mysqli_fetch_assoc($orderResult)){
                            //echo $row['product_id'];
                            $productquery="SELECT * FROM product WHERE Pro_id=".$orderRow['Product_ID'];
                            $productResult=mysqli_query($connection,$productquery) or die('Invalid query:');
                            while($productRow = mysqli_fetch_assoc($productResult)){
                              echo'
                                <div class="row shadow my-2">
                                    <div class="col-md-2 col-4 d-flex align-items-center justify-content-end">
                                        <img src="'.$productRow["Pro_image"].'" alt="Image" style=" max-height:6.2em;">
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <div class="card border-0">
                                          <!-- <h5 class="card-header">User Name</h5> <--></-->
                                          <div class="card-body">
                                            <span class="card-title">'.$productRow["Pro_name"].'</span>
                                            <p>x'.$productRow["Pro_stock"].'</p>
                                            <p>&#8377;'.$productRow["Pro_cost"].'</p>
                                            <div class="d-flex">		
                                                <a href="./add_product.php?id='.$productRow["Pro_id"].'" class="me-2 col-sm-2 btn btn-success">Edit</a>
                                                <a href="./seller_products.php?action=delete&id='.$productRow["Pro_id"].'" class="col-sm-2 btn btn-danger">Delete</a>  
                                            </div>  
                                          
                                           </div>
                                          
                                        </div>
                                    </div>
                                </div>
                            ';
                            }
                          }
                        }
                    ?>
                </div>
            </div>
    </div>
	<?php


?>
</body>
</html>