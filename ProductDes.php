<?php 
    session_start();
    require'./PHP/common_files.php';
    include './PHP/connection.php';
    if(!isset($_SESSION['userid'])){
        echo "<script> location.href='./login.php'; </script>";
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        img{
            max-width: 100%;
        }
        iframe{
            width: 100%;
            height: 20em;
        }
        /*<style>*/
        
        .card{
            width: 12rem;
        }
        .image-wrapper{
            object-fit: cover;
        }
        img{
            object-fit: contain;
        }
        .card-Pro_name{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; 
        }
    </style>
    <title>Product Description</title>
</head>

<body>
<?php 

  include("./PHP/header.php");
  include("./PHP/error.php");
?>
<?php 
    $sql = "SELECT * FROM product where Pro_id=".$_GET['id']."";
    if($result = mysqli_query($connection, $sql)){
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

?>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm-3">
                <div style="max-width:20em;" >
                  <img src="
                  <?php
                      echo $row['Pro_image'];
                  ?>" 
                  style="object-fit: contain;">
                </div>

                <?php 
                    if($row['Pro_stock']>0){
                       echo' <a href="checkout.php?id='.$_GET["id"].'"type="button" class="btn-lg d-block btn-success my-3 w-100 text-center text-decoration-none">Buy Now</a>';
                    }
                 ?>
            </div>
        <div class="col-sm-6 mx-5">
            <h4>  
                <?php 
                    echo $row['Pro_name'];
                ?>
            </h4>
            <h5> 
                &#8377; 
                <?php echo  $row['Pro_cost'];?>
            </h5>   
            <p>Inclusive of all tax</p>
            <form method="post">
                <div class="col-8">
                <div class="input-group">
                    <input type="number" min="1" max="3" name="quantity" class="form-control">
                    <?php
                        if($row['Pro_stock']>0){
                            echo '<button class="btn btn-primary" name="wishlist_button" type="submit">Add to wishlist</button>';
                        }else{
                            echo '<button class="btn btn-secondary" name="wishlist_button" type="submit" disabled>Out of stock</button>';
                        }
                    ?>
                    
                </div>
                </div>
            </form>
                <h3 class="mt-5">Details</h3>
                <p>Product name: <?php 
                echo $row['Pro_name'];
              ?>
                  
              </p>
                <p><b>Sold By: </b><?php 
                echo $row['Pro_seller'];
              ?></p>
               <p>Category: <?php 
                echo $row['Pro_category'];
              ?></p>
              <p>Detail Description: <?php 
                // $text=$row['book_details'];
                // $text=preg_replace('/,/',"<br/>",$text,20);
                echo $row['Pro_details'];
              ?>
              </p>
            </div>
        </div>
        <h4 class="mt-2">Description</h4>
        <p style="text-align: justify;"><?php echo $row['Pro_desc'];
              ?></p>
        <hr/>
    </div>
    <?php 

        include './PHP/footer.php';
     ?>
    <!-- <script src="./bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Cart -->
    <?php
        if(isset($_POST['wishlist_button'])){
            if(!isset($_SESSION['userid'])){
                echo "<script> location.href='./login.php'; </script>";
            }else{
                $quantity=$_POST['quantity'];
                $SQL = "INSERT INTO wishlist (user_id,product_id,quantity) VALUES ('". $_SESSION['userid'] ."','". $_GET['id'] ."','".$quantity."')";  
                $result = mysqli_query($connection,$SQL) or die('Invalid query:'.mysqli_error($connection));
            }
        }
    ?>
</body>

</html>

 
