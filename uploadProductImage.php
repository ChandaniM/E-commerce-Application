<?php 
    session_start();
    require './PHP/common_files.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload Product Image</title>
	<style>
		img{
			max-width: 100%;
		}
	</style>
</head>
<body>
	<?php
	  require './PHP/connection.php';
	  include './PHP/header.php';
	?>
	<?php 
	  require './PHP/error.php';
	 ?>

	<?php 
		$productId='';
		$action='';
		if(isset($_GET['id'])){
			$productId=$_GET['id'];
			if(isset($_GET['action'])){
				$action=$_GET['action'];
			}
		}
	 ?>
	 <div class="container-fluid">
	 	<h3 class="modal-title">Choose product Image</h3>	
	 	<form method="post" enctype="multipart/form-data">
	 	    <!-- <div class="input-group my-3"> -->
	 	    	<div class="mb-3 custom-file col-sm-5">
	 	    	  <label for="formFile" class="form-label">Choose Image</label>
	 	    	  <input class="form-control" type="file" name="file" id="formFile">
	 	    	</div>
	 	        <!-- <div class="custom-file"> -->
<!-- 	 	            <input type="file" name="file" class="custom-file-input" id="productInput" onchange="displayImage()">
	 	            <label class="custom-file-label" for="productInput">Choose Image</label> -->
	 	        <!-- </div> -->
<!-- 	 	        <div class="input-group"> -->
	 	            <button type="submit" class="btn btn-dark input-group-text" name="product-submit" id="product-submit">Upload Image</button>
	 	        <!-- </div> -->
	 	    <!-- </div> -->
	 	</form>
	 	<!-- <div id="display_image_name">
	 	    
	 	</div> -->
	 </div>
	 
	 <?php 
	 	$productImageSql="SELECT `Pro_image` FROM `product` WHERE `Pro_id`='".$productId."'";
	 	// echo $productImageSql;
	 	$productImageResult = mysqli_query($connection, $productImageSql);

	 	if (mysqli_num_rows($productImageResult) > 0) {
	 	  $productImageRow = mysqli_fetch_assoc($productImageResult);
	 	  // if($trigger=="sell"){
	 	  	if(!is_null($productImageRow['Pro_image'])){
	  	 	  echo'
 	  	 	  <div class="container">
 	  		 	  <div class="col-sm-3" style="margin:0 auto;">
 	  		 	  	<div style="max-width:20em; " class="my-2" >
 	  		 	  	  <img src="'.$productImageRow["Pro_image"].'"
 	  		 	  	  style="object-fit: contain;">
 	  		 	  	</div>
  	 	  		 	  <div class="d-flex justify-content-center">		
  		 	  		 	  <a href="./seller_products.php?newproduct=success" class=" me-2 col-sm-6 btn btn-success">Confirm</a>
  		 	  		 	  <a href="./uploadProductImage.php?action=delete&id='.$productId.'" class="col-sm-6 btn btn-danger">Delete</a>  
  		  		 	  </div>
 	  		 	  </div>
 	  		 </div>
	  	 	  ';	
	 	  	}	
	 	  
	 	}
	  ?>
</body>
</html>

<?php
if (isset($_POST["product-submit"])) {
    $file=$_FILES['file'];  
    // File Name
    $fileName=$_FILES['file']['name'];
    // File temporary Name
    $fileTemp=$_FILES['file']['tmp_name'];
    // File Size
    $fileSize=$_FILES['file']['size'];
    //File Error
    $fileError=$_FILES['file']['error'];
    //Type
    $fileType=$_FILES['file']['type'];
    //Extension
    $fileExt=explode('.', $fileName);
    $fileActualExt=strtolower(end($fileExt));
    //Allowed Extensions
    $allowed=array('png','jpeg','jpg');
    //Check for extension
    if(in_array($fileActualExt,$allowed)){
        //If no error in file upload
        if($fileError === 0){
            // FileSize less than 10 MB
            if($fileSize < 10000000){
                $fileNameNew = 'product'.$productId.'.'.$fileActualExt;
                $target_dir = "Uploads/".$_SESSION['userid']."/".$fileNameNew;
                $insertDocument='';
                // if($trigger=="sell"){
                $insertDocument="UPDATE `product` SET `Pro_image`='./".$target_dir."' WHERE `Pro_id`='".$productId."'";	
                // $del='';
                if (mysqli_query($connection, $insertDocument)) {
                    move_uploaded_file($fileTemp, $target_dir);
                    echo 
                    '<script>document.getElementById("alerts").innerHTML=`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          Successfully Uploaded!!
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;</script>
                    ';
                    // if($trigger=="sell"){
		                echo '
		                <script type="text/javascript">
		                	location.href="./redirect.php?id='.$productId.'&trigger=uploadProductImage.php";
		                </script>';
                	// }
                } else {
                  echo '<script>document.getElementById("alerts").innerHTML=`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Error While Uploading File
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;</script>
                    ';;
                }               
                
            }

            else{
                echo
                '<script>document.getElementById("alerts").innerHTML=`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Your File is too big: '.$fileSize.' kbs
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;</script>
                    ';
            }
        }else{
            echo'<script>document.getElementById("alerts").innerHTML=`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Error while uploading file
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;</script>
                    ';
        }

    }else{
        echo'<script>document.getElementById("alerts").innerHTML=`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Invalid File type
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;</script>
                    ';
    }
}



 ?>
<?php
	if($action=="delete"){
		$deleteImage="UPDATE `product` SET `Pro_image`=NULL WHERE `Pro_id`='".$productId."'";
		if (mysqli_query($connection, $deleteImage)) {
			//Delete the file regardless of extension

			$file_pattern = "Uploads/".$_SESSION['userid']."/"."product".$productId.".*";
			array_map("unlink",glob( $file_pattern));
			echo '
			<script type="text/javascript">
				location.href="./redirect.php?id='.$productId.'&trigger=uploadProductImage.php";
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