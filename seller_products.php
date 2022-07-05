<!DOCTYPE html>
<html lang="en">
<?php 
	require('./PHP/connection.php');
	session_start();
	require('./PHP/common_files.php');
	// if(!isset($_SESSION['userid'])){
  //       echo "<script> location.href='./login.php'; </script>";
  //   }
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
            <h2 class="ms-3">Your Products</h2>
            
            <div class="products">
                
                <div class="container">
                    <!-- First -->
                    <?php
                        if(!isset($_SESSION['userid'])){
                            echo "<script> location.href='./login.php'; </script>";
                            exit;
                        }
                        $productquery = "SELECT * from `product` WHERE `seller_id`='".$_SESSION['userid']."'";
                        $productResult=mysqli_query($connection,$productquery) or die(mysqli_error($connection));
                        if(mysqli_num_rows($productResult)<1){
                            echo"You haven't added any products till now!";
                        }
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
                                          </div>
                                          <div class="Row my-4 ">
                                                   <a href="add_product.php?id='.$productRow["Pro_id"].'" name="edit"  class="btn btn-outline-success">EDIT</a>
                                                   <a name="logout" class="btn btn-outline-danger">delete</a>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                            // }
                        }
                    ?>
                </div>
            </div>
    </div>
	
</body>
</html>