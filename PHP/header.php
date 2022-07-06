<?php
    $Account='';
    $wishList='';
    $Account1='';
    $home='<a class="nav-link" href="./index.php">Home</a>';
    // For Seller 
    $sellerPageLink='';
    if(isset($_SESSION['userid'])) {
      $wishList='<a href="./wishlist.php" class="btn btn-success me-2">WISHLIST</a>';
      $Account= '<a href="./AccountInfo.php" class="btn btn-primary">MY ACCOUNT</a>';
      // $home='';
      $sql2="SELECT category FROM customer WHERE userid = ".$_SESSION['userid']."";
      $result = mysqli_query($connection,$sql2);
      $sellerarray=mysqli_fetch_assoc($result);
     if($sellerarray['category']=="Seller"){
        $seller=true;
        $home='<a class="nav-link" href="./seller.php">Home</a>';
        // $Account1.='<a href="./seller.php" class="nav-link active me-2">Seller</a>';
        $wishList='';
      }
    }
    else{
      $Account='<a href="login.php"><button class="btn btn-primary">Login</button></a>';
    }
   
  echo'
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      '.$home.'
                    </li>
                  </ul>
                  <div class="d-flex mx-4">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-value">
                    <button class="btn btn-outline-success" id="search-button">Search</button>
                  </div>
                  '.$wishList.'        
                  '.$Account.'
                          
                      
                </div>
              </div>
            </nav>

        ';
?>
<script src="./JS/search.js"></script>