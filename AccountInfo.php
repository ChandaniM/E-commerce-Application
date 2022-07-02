<?php 
    session_start();

?>
<!DOCTYPE html>
<html>
<head>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    $sql = "SELECT * FROM customer WHERE userid= '".$_SESSION['userid']."'";
                            if($result = mysqli_query($connection, $sql)){
                                //$row = mysqli_fetch_all($result, MYSQLI_NUM);
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo'
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="fname">First Name:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" class="text-input" id="fname" name="name" value="'.$row["Firstname"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="lname">Last Name:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" class="text-input" id="lname" name="lastname" value="'.$row["Lastname"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-25">
                                                <label for="email">E-mail Address:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" class="text-input" name="email" id="email" value="'.$row["Email"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-25">
                                                <label for="phone">PHONE:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="tel" class="text-input" name="tel_num" id="phone" value="'.$row["phone"].'">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="address">Address:</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text"  class="text-input" id="address" name="Address"  
                                                value="'. $row["address"] .'">
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="password">Password:</label>
                                            </div>
                                            <div class="col-75 input-group">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    value="'.$row["password"]
                                                    .'"
                                                >
                                                <div class="px-2 py-2 mx-1" id="password-eye">
                                                    <span class="fas fa-eye-slash d-none" id="hide-pass"></span>
                                                    <span class="fas fa-eye" id="display-pass"></span>
                                                </div>
                                                    
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
            <div class="products">
                
                <div class="container">            <!-- part 1 -->
            <?php 
                if(!isset($_SESSION['userid']) && !$_SESSION['loggedin']==true){
                    echo "<script> location.href='./login.php'; </script>";
                    exit;
                }
                $sql = "SELECT * FROM `order` WHERE User_ID = ".$_SESSION['userid']."";
                $result=mysqli_query($connection,$sql) or die('Invalid query:');
                while($row = mysqli_fetch_assoc($result)){
                    //echo $row['product_id'];
                    $sql2="SELECT * FROM product WHERE Pro_id=".$row['Product_ID'];
                    $result2=mysqli_query($connection,$sql2) or die('Invalid query:');
                    // while($row2 = mysqli_fetch_assoc($result2)){
                    $row2 = mysqli_fetch_assoc($result2);
                        echo'
                            <div class="row shadow my-2">
                               <div class="col-md-2 col-4 d-flex align-items-center justify-content-end">
                                   <img src="'.$row2["Pro_image"].'" alt="Image" style=" max-height:6.2em;">
                               </div>
                               <div class="col-md-8 col-6">
                                   <div class="card border-0">
                                     <!-- <h5 class="card-header">User Name</h5> <--></-->
                                     <div class="card-body">
                                       <span class="card-title">'.$row2["Pro_name"].'</span>
                                       <p class="">x'.$row["Quantity"].'</p>
                                       <p>&#8377;'.$row["Quantity"]*$row2["Pro_cost"].'</p>
                                     </div>
                                   </div>
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
            $FirstName=$_POST["name"];
            $LastName=$_POST["lastname"];
            $email=$_POST["email"];
           $phone=$_POST["tel_num"];
            $Address=$_POST["Address"];
            $password=$_POST["password"];
            $sql="UPDATE customer SET Firstname='$FirstName',Lastname='$LastName',Email='$email',password='$password',phone='$phone',address='$Address' WHERE userid = ".$_SESSION['userid']."";
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
    <script>
        document.getElementById('password-eye').addEventListener('click',()=>{
            let display_pass=document.getElementById('display-pass');
            if(!display_pass.classList.contains('d-none')){
                document.getElementById('hide-pass').classList.remove('d-none');
                document.getElementById('password').type="text";
                display_pass.classList.add('d-none')
            }else{
                document.getElementById('hide-pass').classList.add('d-none');
                document.getElementById('password').type="password";
                display_pass.classList.remove('d-none')
            }
            
        });
    </script>
</body>
</html>