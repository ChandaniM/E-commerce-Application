<?php
	session_start();
	require './PHP/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<header>
		<?php
			include './PHP/header.php';
		    require './PHP/common_files.php';

		?>
	</header>
	<h1 class="head">
		MY CART
	</h1>


		<div class="products">
			<div class="products-container container">
				<!-- First -->
				<?php
					if(!isset($_SESSION['userid']) && !$_SESSION['loggedin']==true){
	                	echo "<script> location.href='./login.php'; </script>";
	            		exit;
	            	}
						$sql = "SELECT * FROM wishlist WHERE user_id = ".$_SESSION['userid']."";
						$result=mysqli_query($connection,$sql) or die('Invalid query:');
						while($row = mysqli_fetch_assoc($result)){
					        $sql2="SELECT * FROM product WHERE Pro_id =".$row['product_id ']."";
					        $result2=mysqli_query($connection,$sql2) or die('Invalid query:');
					        $row2 = mysqli_fetch_assoc($result2);
				        	echo'
								<div class="col-8">
			 						<div class="card my-2">
			 			                <div class="row">
			 			                    <div class="col-md-3">
			 			                      <img src="'.$row2["Pro_image"].'" alt="Image" class="img-fluid rounded-start" style="object-fit: contain; width:8em;">
			 			                    </div>
			 			                    <div class="col-md-9">
			 			                      <div class="card-body">
			 			                        <h5 class="card-title">'.$row2["Pro_name"].'</h5>
			 			                        <p class="card-text">'.$row["quantity"].'</p>
			 			                        <p class="card-text">&#8377;'.$row2["Pro_cost"].'</p>
			 			                        <a href="./cart.php?id='.$row["pro_id"].'&cart_id='.$row["wishlist_id"].'" class="btn btn-outline-danger"><b>Remove</b></a>
			 			                      </div>
			 			                    </div>
			 			                 </div>
			 						</div>
			 					</div>

								';
					 }
				?>
				
			</div>



	<!-- ORDER -->
		<form method="post">
			<button class="order-button" name='order'>CONFIRM ORDER</button>
		</form>

		<?php
				if(isset($_POST['order'])){
				//Date after 6 days
				$datetime = new DateTime(date('Y-m-d'));
				$datetime->add(new DateInterval("P6D"));
				$format=$datetime->format('Ymd');
				//echo(date('Y-m-d').' '.$format);
				$sql = "SELECT * FROM wishlist WHERE user_id = ".$_SESSION['userid']."";
				$result=mysqli_query($connection,$sql) or die('Invalid query:');
				while($row = mysqli_fetch_assoc($result)){
					$sql2="SELECT Pro_cost FROM product WHERE Pro_id=".$row['product_id']."";
			        $result2=mysqli_query($connection,$sql2) or die('Invalid query:');
			        $row2 = mysqli_fetch_assoc($result2);
			        // while($row2 = mysqli_fetch_assoc($result2)){
			        	$cost=$row['quantity']*$row2['Pro_cost'];
			        	$date=date('Ymd');
						$sql3='INSERT INTO `Order` (User_ID, Product_ID, Quantity, Total_Amount, Order_Date, Delivery_Date, Status) VALUES ('.$_SESSION["userid"].', '.$row["product_id"].', '.$row["quantity"].', '.$cost.', '.$date.', '.$format.',	"In Progress")';
						$result3=mysqli_query($connection,$sql3) or die('Invalid query:'.mysqli_error($connection));
						//echo "<script>location";
					// }
				}
				echo "<script> location.href='./AccountInfo.php'; </script>";
			}
			if(isset($_GET['id'])){
				$sql= "DELETE FROM  wishlist WHERE user_id=". $_SESSION['userid'] ." AND pro_id=".$_GET['id'];
				$result=mysqli_query($connection,$sql) or die('Invalid query:'.mysqli_error($connection));
				echo("<script>location.href='./wishlist.php';</script>");
			}
		?>
	</div>
	<?php
	    include'./PHP/footer.php';
	  ?>
	</div>
</body>
</html>