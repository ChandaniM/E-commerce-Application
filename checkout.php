<?php 
	session_start();
	require './PHP/connection.php';
	require './PHP/common_files.php';
	$selectOrder='';
	$insertOrder='';
	$flag=0;
	$quantity=0;
	$data=array();
	$final_price=0;
	if(isset($_GET['id'])){
		// flag 1 => buy now 
		$selectOrder="SELECT * FROM product WHERE Pro_id=".$_GET['id'];
		$flag=1;
	}else{
		// flag 0 => wishlist
		$selectOrder="SELECT * FROM wishlist WHERE user_id=".$_SESSION['userid'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./CSS/checkout.css">
	<title>Order Page</title>
</head>
<body>
	<?php 
		require './PHP/header.php';
	 ?>
	 <div class="container my-5 px-5">
	     <div class="mb-4">
	         <h2>Confirm order</h2>
	     </div>
	     
	     <div class="row mb-3">
	     	<div class="col-md-8">
	     		<div class="card p-3">
	     			<h6>ORDER DETAILS</h6>
		 		     <?php 
		 		     	$result = mysqli_query($connection, $selectOrder);
		 		     	if($flag==0){
		 		     		// wishlist
		 	                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 	                	
		 	                	$sql2="SELECT * FROM product WHERE Pro_id=".$row['product_id']."";
		 	                	$result2=mysqli_query($connection,$sql2) or die('Invalid query:');
		 	                	$row2 = mysqli_fetch_assoc($result2);
		 	                	// array fill product cost
		 	                		$data += array($row['product_id'] => $row["quantity"].",".$row2["Pro_cost"].",".$row2["seller_id"]);
		 	                		$final_price+=$row2["Pro_cost"];
		 	                		echo
		 	                		'
	    				 		     <div class="d-flex my-2">
	    					 		     <div class="col-md-2 col-5 d-flex justify-content-center">
	    					 		         <img src="'.$row2["Pro_image"].'" class="" alt="Image" style=" max-height:8em; ">
	    					 		     </div>
	    					 		     <div class="col-md-8 col-7 border-bottom border-default">
	    					            	<div class="card border-0">
	    			                  			<div class="card-body">
	    				                    		<h6 class="card-title">'.$row2["Pro_name"].'</h6>
	    					                    	<span class="card-text d-block">&#8377;'.$row2["Pro_cost"].'</span>
	    					                    	<span class="card-text d-block"><b>Quantity: </b>'.$row["quantity"].'</span>
	    					                  	</div>
	    					                </div>
	    					            </div>
	    					        </div>
		 	                		';
		 	                }
		 	                
		 		     		
		 		     	}else{
		 		     		// buy now
		 	                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 	                		$final_price=$row["Pro_cost"];
		 	                		$date=date('dmY');
		 	            	
		 	                		echo
		 	                		'
	    				 		     <div class="d-flex">
	    					 		     <div class="col-md-2 col-5 d-flex justify-content-center">
	    					 		         <img src="'.$row["Pro_image"].'" class="" alt="Image" style=" max-height:8em; ">
	    					 		     </div>
	    					 		     <div class="col-md-8 col-7 border-bottom border-default">
	    					            	<div class="card border-0">
	    			                  			<div class="card-body">
	    				                    		<h6 class="card-title">'.$row["Pro_name"].'</h6>
	    					                    	<span class="card-text d-block">&#8377;'.$row["Pro_cost"].'</span>
	    					                    	<span class="card-text d-block"><b>Quantity: </b>1</span>
	    					                  	</div>
	    					                </div>
	    					            </div>
	    					        </div>
		 	                		';
		 	                }

		 	                $insertOrder='INSERT INTO order_table (User_ID, Product_ID, Quantity, Total_Amount, Order_Date,Status,Seller_ID) VALUES ('.$_SESSION["userid"].', '.$_GET["id"].', 1, '.$final_price.', '.$date.',"In Progress",'.$row2["seller_id"].')';
										}
		 		     	
		 		     ?>
		 		     
	     		</div>
	     	</div>
	     	<div class="col-md-4">
	             <div class="card card-blue p-3 text-white mb-3"> <span>You have to pay</span>
	                 <div class="d-flex flex-row align-items-end mb-3">
	           
	                     <h1 class="mb-0 yellow">&#8377;<?php echo $final_price; ?></h1>
	                 </div> 
	             </div>
	         </div>
	     </div>
	     <div class="row">
	         <div class="col-md-8">
	             <div class="card p-3">
	                 <h6 class="text-uppercase">Payment details</h6>
	                 <?php 
				     	$sql_user = "SELECT * FROM customer WHERE  userid=". $_SESSION['userid'];
			            if($result_user = mysqli_query($connection, $sql_user)){
			                //$row = mysqli_fetch_all($result, MYSQLI_NUM);
			                while ($row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC)) {
			                	echo'
	                		    	<div class="form-floating">
	                		    		<input type="text" name="username" class="form-control" required="required" value="'.$row_user["Firstname"].' '.$row_user["Lastname"].'" placeholder="Username">
		                		    	<label for="username">Username</label>
		                		    </div>
		                		    <div class="row">
		                		        <div class="col-md-6">
		                		            <div class="inputbox form-floating mt-3 mr-2"> 
		                		            	<input type="text" name="phone" class="form-control" required="required" value="'.$row_user["phone"].'" placeholder="Phone"> <i class="fa fa-phone mt-3"></i>
		                		            	<label for="phone">Phone</label>
		                		            </div>
		                		        </div>
		                		        <!--<div class="col-md-6">
		                		            <div class="d-flex flex-row">
		                		                <div class="inputbox mt-3 mr-2"> 
		                		                	<input type="text" name="name" class="form-control" required="required">
		                		                </div>
		                		                <div class="inputbox mt-3 mr-2"> 
		                		                	<input type="text" name="name" class="form-control" required="required">
		                		                </div>
		                		            </div>
		                		        </div>-->
		                		    </div>
		                		    <div class="mt-4 mb-4">
		                		        <h6 class="text-uppercase">Billing Address</h6>
		                		        <div class="row mt-3">
		                		            <div class="col-md">
		                		                <div class="inputbox form-floating mt-3 mr-2"> 
		                		                	<input type="text" name="address" class="form-control" required="required" placeholder="Address"
		                		                		value="'.$row_user["address"].'" 
		                		                	>
		                		                	<label for="address">Address</label>
		                		                </div>
		                		            </div>
		                		            <!-- <div class="col-md-6">
		                		                <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>City</span> </div>
		                		            </div> -->
		                		        </div>
		                		       <!--  <div class="row mt-2">
		                		            <div class="col-md-6">
		                		                <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>State/Province</span> </div>
		                		            </div>
		                		            <div class="col-md-6">
		                		                <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>Zip code</span> </div>
		                		            </div>
		                		        </div> -->
		                		    </div>
		                		</div>
		                		<form method="POST" class="mt-2 mb-4 d-flex justify-content-between"> 
		                			<button class="btn btn-success px-3" type="submit" name="confirm_order">Confirm</button> </form>
			                	';
			                }
			            }
				     ?>
	                 
	         </div>
	         
	     </div>
	</div>

	 <?php 
	 	require './PHP/footer.php'; 
	 ?>
	 <?php
	 	if(isset($_POST['confirm_order'])){
	 		if($flag==0){
	 			$date=date('dmY');

		 	                	
	 			foreach ($data as $key => $value) {
	 				$a=explode(',', $value);
	 				$insertOrder="INSERT INTO order_table(User_Id,Product_Id,Quantity,Total_Amount,Order_Date,Status,Seller_ID)VALUES(".$_SESSION['userid'].",".$key.",".$a[0].",".$a[1].",".$date.",'In Progress',".$a[2].")";                                                                                     
					$result = mysqli_query($connection,$insertOrder);
					if($result){
						  		echo "<script>location.href='./AccountInfo.php';</script>";
					}else{
					  	echo(mysqli_error($connection));
					}                          
	 			}	
	 		}else{
	 			$result = mysqli_query($connection,$insertOrder);
	 			if($result){
	 				$msg = "<script>alert('Success')</script>";
	 				echo "<script>location.href='./AccountInfo.php';</script>";
	 			}else{
	 			  	echo(mysqli_error($connection));
	 			}
	 		}
	 	}
	  ?>
</body>
</html>