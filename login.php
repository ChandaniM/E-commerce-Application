    <?php
    session_start();
    include './PHP/connection.php';
    include './PHP/common_files.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form mt-4 p-4 shadow ">
                    <form action="" method="POST" class="row g-3">
                        <h4>Login</h4>
                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-12">
                            <button type="submit" name="login-submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Have not account yet? <a href="signup.php">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            if (isset($_POST['login-submit'])){
                
                    $email = $_POST['email'];
                    //echo $email;
                    $password = $_POST['password'];
                    
                    $sql= "SELECT * FROM customer WHERE Email = '$email' AND password = 
                    '$password'";
                    $result = mysqli_query($connection,$sql);
                    if(isset($result)){
                        $check = mysqli_fetch_assoc($result);
                        $_SESSION['userid']=$check['userid'];
                        if($check["category"]=="Seller"){
                            echo "<script> location.href='./seller.php'; </script>";
                        }else{
                            echo "<script> location.href='./index.php'; </script>";
                        }
                        exit;
                    }

                    else{
                        echo 'failure';
                    }
                }
    ?>
</body>
</html>