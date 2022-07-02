<?php
    $Account='';
    // For Seller 
    $sellerPageLink='';
    if(isset($_SESSION['userid']) && $_SESSION['loggedin']==true) {
      $Account.='<a href="./wishlist.php" class="btn btn-success me-2">WISHLIST</a> <a href="./AccountInfo.php" class="btn btn-primary">MY ACCOUNT</a>';
    }
    else{
      $Account.='<a href="login.php"><button class="header-button">SIGN IN</button></a>';
    }

	echo'
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                  </ul>
                  <form class="d-flex mx-4">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                    
                          <!--<a href="./login.php"  style="color:#fff; text-decoration: none;">Login</a>-->
                          '.$Account.'
                      
                </div>
              </div>
            </nav>

        ';
?>