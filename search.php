<?php
	 session_start();
    require './PHP/connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search</title>
	<style>
		.flex-wrapper {
			display: flex;
			flex-direction: column;
		    justify-content: space-between;
		}
	</style>
</head>

<body>
<?php 
	include'./PHP/header.php';
	require './PHP/common_files.php';
?>
<div class="flex-wrapper">
	<div class="container">		
		<h2>Search Results: </h2>
	<?php
			if(isset($_GET['value'])){
				$searchterm=$_GET['value'];	
				$sql="SELECT * FROM product WHERE Pro_name LIKE '%$searchterm%' OR Pro_category='$searchterm'";
			    $result=mysqli_query($connection,$sql);
				if(mysqli_num_rows($result)>0){		
					while($row = mysqli_fetch_assoc($result)){		
					echo'
				        <div class="row py-2 border ">
				            <div class="col-md-2 col-5 d-flex justify-content-end ">
				                <img src="'.$row["Pro_image"].'" class="" alt="Image" style=" max-width:8em; ">
				            </div>
				            <div class="col-md-8 col-7">
				            	<div class="card border-0">
		                  			<div class="card-body">
						                <a href="./book_desc.php"></a>
			                    		<h5 class="card-title">'.$row["Pro_name"].'</h5>
				                    	<div class="rating">
				                    		'.$row["Pro_seller"].'
			                    		</div>
				                    	<span class="card-text d-block">&#8377;'.$row["Pro_cost"].'</span>
				                    	<div class="d-flex py-2">
				                        	<a href="ProductDes.php?id='.$row["Pro_id"].'" class="btn btn-primary"><b>VIEW PRODUCT</b></a>
				                       	</div>
				                  	</div>
				                </div>
				            </div>
				        </div>
				        <hr>
				        <div class="card mb-3 me-3" style="max-width:640px;">
				        	<div class="row g-0">
				        	    <div class="col-md-4">
				        	      <img src="'.$row["Pro_image"].'" class="img-fluid rounded-start" alt="..." style=" ">
				        	    </div>
				        	    <div class="col-md-8 d-flex">
				        		    <div class="card-body justify-content-between align-items-start align-self-center">
				        		        <h5 class="card-title">'.$row["Pro_name"].'</h5>
				        		        <h6>Sold by: '.$row["Pro_seller"].'</h6>
				        		       	<p class="card-text">&#8377;'.$row["Pro_cost"].'</p>
				        	        	<div class="d-flex me">
				        	            	<a href="ProductDes.php?id='.$row["Pro_id"].'" class="btn btn-primary"><b>VIEW PRODUCT</b></a>
				        	           	</div>
				        		    </div>
				        	    </div>
				        	</div>
				        </div>

				        ';
				   	}
				}else{
				 	echo "<p class='mb-5'>No Products found!</p>";
				}

			}else{
				echo"Not Found";
			}   
	?>
	   </div>
	   
       <?php include'./PHP/footer.php' ?>
</div>
</body>
</html>