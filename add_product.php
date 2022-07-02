<?php 
    session_start();
    require './PHP/common_files.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add new Product</title>
</head>
<body>
  <?php
    require './PHP/connection.php';
    include './PHP/header.php';
  ?>
  <?php 
    require './PHP/error.php';
   ?>
  <!-- <div class="top"></div> -->
   
  <div class="container p-2">
    <h3>Enter Product details</h3>
    <?php 
        echo'
          <form method="post">
            <div class="form-group  mb-4 col-sm-8">
              <label for="product-title" >Enter product title</label>  
              <input type="text" class="form-control" name="product-title" id="product-title" >       
            </div>

            <div class="form-group mb-4 col-sm-8">
              <label class="form-label" for="product-description">Description</label>
              <textarea class="form-control" id="product-description" rows="4" name="product-description"></textarea>
            </div>
            

           <!-- <div class="form-group mb-4 col-sm-8">
              <label for="product-category" >Enter Category</label>
              <input type="text" class="form-control" name="product-category" id="product-category">  
            </div>-->

            <div class="form-group mb-4 col-sm-8">
              <label class="form-label" for="product-specification">Specification</label>
              <textarea class="form-control" id="product-specification" rows="4" name="product-specification"></textarea>
            </div>


            <div class="form-group mb-4 col-sm-8">
            <label class="form-label" for="product-categoru">Choose a product category</label>
              <select class="form-select" aria-label="Choose a product category"  name="product-category">
                <option value="" selected disabled hidden>Select one</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="form-group mb-4 col-sm-4">
              <label for="product-cost">Cost</label>
              <input type="number" class="form-control" id="product-cost" name="product-cost" min="0.0" step="0.01" placeholder="0.0">     
            </div>

            <div class="form-group mb-4 col-sm-4">
              <label for="product-quantity">Quantity of products</label>
              <input type="number" class="form-control" id="product-quantity" name="product-quantity">     
            </div>            

            <div class="col-auto">
              <button type="submit" class="btn btn-primary" name="sell-details-submit">Submit</button>
            </div> 
         </form>
        ';
      
    ?>
      
  </div>
        
<?php

// $_SESSION['userid']
  if(isset($_POST['product-details-submit'])){
      $productTitle= $_POST['product-title'];
      $productDescription= mysqli_real_escape_string($connection,$_POST['product-description']);
      $productSpecification= mysqli_real_escape_string($connection,$_POST['product-specification$productspecification']);
      $productCategory= $_POST['product-category'];
      $productCost = floatval($_POST['product-cost']);
      $productQuantity=$_POST['product-quantity'];
      //Search products
      $productSearch = "SELECT 1 from product WHERE Pro_name=(SELECT Pro_name FROM product where seller_id='".$_SESSION['userid']."')";
      // echo $productSearch;
      $queryResult= mysqli_query($connection,$productSearch);
      //if product exists    
      if (mysqli_num_rows($queryResult)>0) {
        $product_data = mysqli_fetch_assoc($queryResult);
        $newQuantity=(int)$product_data['stock']+(int)$productQuantity;
        //update stock
        $updateStock="UPDATE `product` SET `stock`='".$newQuantity."' WHERE `Pro_name`='".$product_data['Pro_name']."' AND `seller_id`='".$_SESSION['userid']."'";
        print_r($product_data);
        if (mysqli_query($connection, $updateStock)) {
          echo "<script>location.href='./seller_products.php?result=success'</script>";
        } else {
          echo '<script>document.getElementById("alerts").innerHTML=`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Error Updating Product Data.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          `;</script>';
        }
      }else{
        //input for url(image would ne added on next page)
        $productInsert="INSERT INTO `product`(`Pro_name`, `Pro_desc`, `Pro_cost`, `Pro_stock`, `Pro_category`, `Pro_details`,`seller_id`) VALUES ('$productTitle', '$productDescription','$productCost','$productQuantity','$productCategory','$productSpecification','".$_SESSION['userid']."')";
        echo $productInsert;
        // get id of inserted product: 
        if (mysqli_query($connection, $productInsert)) {
          // $productID=mysqli_insert_id($connection);
          // $sellInsert="INSERT INTO `sell_products`(`user_id`, `product_id`) VALUES (".$_SESSION['userid'].",'$productID')";
          // if (mysqli_query($connection, $sellInsert)) {
          //   echo "<script>location.href='./uploadproductImage.php?id=".$productID."&trigger=sell'</script>";
          // }else{
          //   echo '<script>document.getElementById("alerts").innerHTML=`
          //   <div class="alert alert-danger alert-dismissible fade show" role="alert">
          //     Error Updating Product Data.
          //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          //   </div>
          // `;</script>';
          // }
          echo "<script>location.href='./uploadproductImage.php?id=".$productID."'</script>";                              
        } else {
          echo(mysqli_error($connection));
          echo '<script>document.getElementById("alerts").innerHTML=`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Error Updating product Data.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          `;</script>';
        }
        
      }

  }
   
  ?>       

  <?php
    // require './PHP/footer.php';
  ?>
  <!-- <script type="text/javascript">
    let url=location.href;
    url=(url.includes('&'))?url.split('&')[1].split("=")[1]:'';
    if(url){
      document.getElementById("product-google-title").value=sessionStorage.getItem('productName');
      document.getElementById("product-google-description").innerHTML=sessionStorage.getItem('productDescription');
      document.getElementById("product-google-category").value=sessionStorage.getItem('productCategory');
      document.getElementById("product-google-author").value=sessionStorage.getItem('productAuthor');
    }
  </script> -->
</body>
</html>

