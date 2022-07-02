<?php 
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
	
    <link rel="stylesheet" href="./CSS/footer.css">
    <link href="./CSS/account.css" rel="stylesheet" type="text/css">    
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/header.css">
</head>
<body>
    <!-- <header> -->
        <?php
            include './PHP/connection.php';
            include './PHP/header.php';
            include './PHP/common_files.php';


        ?>
    <!-- </header> -->
    <div class="top">
        <div class="container-box">
            <h2> Profile Details</h2>
            <form action="" method="post">
                <?php
                if(!isset($_SESSION['userid']) && !$_SESSION['loggedin']==true){
                    header('Location:./loginform.php');
                }
                    $sql = "SELECT * FROM customer WHERE customer_id= ".$_SESSION['userid']."";
                            if($result = mysqli_query($connection, $sql)){
                                //$row = mysqli_fetch_all($result, MYSQLI_NUM);
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo'
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="fname">First Name:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" class="text-input" id="fname" name="firstname" value="'.$row["First_Name"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="lname">Last Name:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" class="text-input" id="lname" name="lastname" value="'.$row["Last_Name"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-25">
                                                <label for="email">E-mail Address:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" class="text-input" name="email" id="email" value="'.$row["Email_Id"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-25">
                                                <label for="phone">PHONE:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="tel" class="text-input" name="phone" id="phone" value="'.$row["Phone_Num"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="address">Address:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text"  class="text-input" id="address" name="address"  
                                                value="'. $row["Address"] .'">
                                           </div>
                                        </div>
                                        <div class="row">
                                            <form mehod="post">
                                                <button name="edit" class="edit-button button">Edit</button>
                                                </form>
                                                <button class="logout button" name="logout">LOGOUT</button>
                                        </div>
                                    ';
                                }
                            }

                ?>
            </form>
        </div>
    </div>

    <div class="mid">
        <div class="container-box">
            <!-- Order DB -->
            <h2>Order Details</h2>
            <div class="middle-page">
        <div class="cart-page">
            <!-- part 1 -->
            <?php 
                if(!isset($_SESSION['userid']) && !$_SESSION['loggedin']==true){
                    echo "<script> location.href='./loginform.php'; </script>";
                    exit;
                }
                $sql = "SELECT * FROM `Order` WHERE customer_id = ".$_SESSION['userid']."";
                $result=mysqli_query($connection,$sql) or die('Invalid query:');
                while($row = mysqli_fetch_assoc($result)){
                    //echo $row['product_id'];
                    $sql2="SELECT * FROM dishes WHERE dish_id=".$row['dish_id'];
                    $result2=mysqli_query($connection,$sql2) or die('Invalid query:');
                    // while($row2 = mysqli_fetch_assoc($result2)){
                    $row2 = mysqli_fetch_assoc($result2);
                        echo'
                            <div class="cart--1 flex-space">
                                <div class="img-container">
                                    <img src="'.$row2["image"].'" class="Images--dish" alt="">
                                </div>
                                <div class="cart--detail flex-space">
                                    <span class="dish--name dish--items">'.$row2["dish_name"].'</span>
                                    <span class="dish--quanity dish--items">x'.$row["quantity"].'</span>
                                    <span class="dish--price dish--items">&#8377;'.$row["quantity"]*$row2["cost"].'</span>
                                </div>
                            </div>
                        ';  
                    // }
                }
            ?>
        </div>
    </div>
            
        </div>
    </div>
    <?php
        if(isset($_POST['edit'])){
            $FirstName=$_POST["firstname"];
            $LastName=$_POST["lastname"];
            $email=$_POST["email"];
            $phone=$_POST["phone"];
            $Address=$_POST["address"];
            $sql="UPDATE customer SET First_Name='$FirstName',Last_Name='$LastName',Email_Id='$email',Phone_Num='$phone',Address='$Address' WHERE customer_id = ".$_SESSION['userid']."";
            $result = mysqli_query($connection,$sql) or die('Invalid query:'.mysqli_error($connection));
        }
        if(isset($_POST['logout'])){
            unset($_SESSION['userid']);
            $_SESSION['loggedin']=false;
            session_destroy();
            echo "<script> location.href='./index.php'; </script>";
            exit;
        }
    ?>
    <!-- <footer> -->
        <?php
            include './PHP/footer.php';
        ?>
    <!-- </footer> -->
    <script src="./headerLogic.js"></script>
</body>
</html>