<!DOCTYPE html>
<html lang="en">
<?php 
    require('./PHP/connection.php');
    session_start();
    require('./PHP/common_files.php');
    if(!isset($_SESSION['userid'])){
        echo "<script> location.href='./login.php'; </script>";
    }
    $productId='';
    $action='';
    if(isset($_GET['id'])){
        $productId=$_GET['id'];
        if(isset($_GET['action'])){
            $action=$_GET['action'];
        }
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
                                                <a href="./ProductDes.php?id='.$productRow["Pro_id"].'" class="text-decoration-none link-dark">    
                                                    <span class="card-title">'.$productRow["Pro_name"].'</span>
                                                    <p>x'.$productRow["Pro_stock"].'</p>
                                                    <p>&#8377;'.$productRow["Pro_cost"].'</p>
                                                </a>
                                                    <div class="d-flex">        
                                                        <a href="./add_product.php?id='.$productRow["Pro_id"].'" class="me-2 col-sm-2 btn btn-success">Edit</a>
                                                        <a href="./seller_products.php?action=delete&id='.$productRow["Pro_id"].'" class="col-sm-2 btn btn-danger">Delete</a>  
                                                    </div>  
                                                
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
    <?php

    if($action=="delete"){
        // $productId=$_GET['id'];
        $deleteProduct="DELETE from `product` WHERE `Pro_id`='".$productId."'";
        if (mysqli_query($connection, $deleteProduct)) {
            echo '
            <script type="text/javascript">
                location.href="./redirect.php?trigger=seller_products.php";
            </script>';
        } else {
          echo'<script>document.getElementById("alerts").innerHTML=`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Error Deleting Record
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;</script>
                    ';
        }
    }

?>
</body>
</html>