<?php
    session_start();
    require './PHP/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-Commerce Application</title>
</head>
<body>
		<header>
		  <?php
		    include'./PHP/header.php';
		    require './PHP/common_files.php';
		    //Connect mtlb tera connection ka fi
		  ?>
		</header>
		<div class="container-fluid">
			<?php
                $sql = "SELECT * FROM product";
                $rate='';
                $non='';
                $sale='';
                            if($result = mysqli_query($connection, $sql)){
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $rate='';
                                    $non='';
                                    $sale='';/**/
                                    //wo rating ka tha
                                    // if($row["Pro_offer"]>0){
                                    //     $sale.='<span class="">'.$row["Pro_offer"].'% OFF</span> ';
                                    // }else{
                                    //     $sale.='';
                                    // }
                                    echo '
                                        <a href="ProductDes.php?id='.$row["Pro_id"].'" class="text-decoration-none link-dark">
                                			<div class=" p-3 d-inline-block">
                                			   <a href="ProductDes.php?id='.$row["Pro_id"].'" class="text-decoration-none link-dark">
                                                    <div class="card " style="width: 18rem;">
                                                        <div class="ratio ratio-4x3" style="object-fit: cover;">
                                                        	'.$sale.'
                                                            <img src="'.$row["Pro_image"].'" alt="'.$row["Pro_name"].'" class="card-img-top py-2" style="object-fit: contain;"  alt="image" loading="lazy">
                                                        </div>
                                                        <div class="card-body">
                    										<p class="card-text">&#8377;'.$row["Pro_cost"].'</p>
                                                            <div class=""> 
                                                              <a href="./index.php?id='.$row["Pro_id"].'" class="btn btn-primary ">Add To Wishlist</a> 
                                                             </div>

                                                        </div>
                                                    </div>
                                                </a>    
                                             </div>
                                        </a>
                                  <!--  <div>-->
                                    ';
                                }
        
                            }
            ?>
		</div>
		 <?php
		    include'./PHP/footer.php';
		  ?>
           <?php
                if(isset($_GET['id'])){
                    if(!isset($_SESSION['userid']) && !$_SESSION['loggedin']==true){
                        echo "<script> location.href='./login.php'; </script>";
                    }else{
                        $SQL = "INSERT INTO wishlist (user_id,product_id,quantity) VALUES ('". $_SESSION['userid'] ."','". $_GET['id'] ."','". 1 ."')";  
                        $result = mysqli_query($connection,$SQL) or die('Invalid query:'.mysqli_error($connection));
                    }
                }
            ?>
</body>
</html>