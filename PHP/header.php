<?php
    $Account='';
     $Account1='';
    
    // For Seller 
    $sellerPageLink='';
    if(isset($_SESSION['userid']) && $_SESSION['loggedin']==true) {
      $Account.='<a href="./wishlist.php" class="btn btn-success me-2">WISHLIST</a> <a href="./AccountInfo.php" class="btn btn-primary">MY ACCOUNT</a>';
      $sql2="SELECT category FROM customer WHERE userid = ".$_SESSION['userid']."";
      $result = mysqli_query($connection,$sql2);
      $sellerarray=mysqli_fetch_assoc($result);
     if($sellerarray['category']=="Seller"){
         $Account1.='<a href="./seller.php" class="nav-link active me-2">Seller</a>';
     }
    }
    else{
      $Account.='<a href="login.php"><button class="btn btn-primary">Login</button></a>';
    }
   
	echo'
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li>
                       '.$Account1.'
                    </li>
                  </ul>
                  <form class="d-flex mx-4">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                          '.$Account.'
                          
                      
                </div>
              </div>
            </nav>

        ';
?>