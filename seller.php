<?php
  session_start();
  require './PHP/connection.php';
  require './PHP/common_files.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller</title>
</head>
<body>
<?php
  require './PHP/header.php';
?>
<h1 class="text-center">Welcome To Seller Page</h1>
  <div class="container d-flex align-items-center justify-content-center" style="width:60%;min-height:60vh;">
    <div class="row align-items-center justify-content-center" style="height:30vh">
      <a href="./add_product.php" class="btn btn-outline-primary">Add Product</a>
      <a href="./seller_products.php" class="btn btn-outline-secondary">Your Products</a>
      <a href="./seller_orders.php" class="btn btn-outline-success">Order History</a>
    </div>
  </div>
  <?php
  require './PHP/footer.php';
?>
</body>
</html>