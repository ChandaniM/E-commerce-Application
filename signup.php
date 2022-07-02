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
	<title>E-Commerce Application</title>
	<style>
        .signup-form{
            padding-bottom:0.2em ;
        } 
        .radio-input{
        	width:40%;
        	border: 1px solid darkgrey;
        }
        .hide{
            display: none;
        }
    </style>

</head>
<body>
 <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="signup-form shadow">
                <form class="mt-5 border p-4 " method="POST" autocomplete="off">
                    <h4 class="mb-5 text-secondary">Create Your Account</h4>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>First Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter First Name" required='true'>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label>Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name" required='true'>
                        </div>
                         <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required='true'>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Address<span class="text-danger">*</span></label>
                            <input type="text" name="Address" class="form-control" placeholder="Enter Address" required='true'>
                        </div>
                         <div class="mb-3 col-md-12">
	                       	<select name="option">
	                       	   <option value="Customer">Customer</option>
	                       	   <option value="Seller">Seller</option>
	                       	 </select>                    
	                    </div>
                        <div class="mb-3 col-md-12">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="tel_num" placeholder="Enter Phone" required='true'>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password"  class="form-control password" name="pass" placeholder="Enter Password">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" name="pass" class="form-control repassword"  placeholder="Confirm Password">
                            <span class="hide" id="hide">your password is not same</span>
                        </div>
                        <div class="col-md-12">
                           <button class="btn btn-primary" name="signup-submit" class="signup-submit-button ">Signup</button>
                               
                        </div>
                    </div>
                </form>
                <p class="text-center mt-3 text-secondary">If you have account, Please <a href="login.php">Login Now</a></p>
            </div>
        </div>
    </div>
</div>

<?php
	 if(isset($_POST['signup-submit'])){
			$FirstName=$_POST["name"];
			$LastName=$_POST["lastname"];
			$email=$_POST["email"];
			$phone=$_POST["tel_num"];
			$Address=$_POST["Address"];
			$pas=$_POST["pass"];
			$category=$_POST["option"];
            // $query = "SELECT 1 FROM customer WHERE Email = '$email'";
            // $selectresult = mysqli_query($connection, "SELECT 1 FROM customer WHERE Email = '$email'");
            // if(mysqli_num_rows($selectresult)>0){
            //     $msg = 'email already exists';
            // }
            // else{
                $SQL = "INSERT INTO Customer (Firstname,Lastname,Email,phone,address,password,category) VALUES ('". $FirstName ."','". $LastName ."','". $email ."',". $phone .",'". $Address ."','". $pas ."','". $category ."')";
                $result = mysqli_query($connection,$SQL);
                // if($result){
                //         $newuserid=mysqli_insert_id($connection);
                //         $_SESSION['userid']=$newuserid;
                //         //Create folder for user
                //         $usercategory=mysqli_fetch_assoc($category);
                //             if($usercategory['category']=="Seller"){
                //                 mkdir('./Uploads/'.$newuserid,0777,true);
                //             }
                //             echo'
                //             <script>
                //               location.href="./index.php";
                //             </script>';   
                // }
                // else{
                    echo(mysqli_error($connection));
                // }
            // }
			
	}
?>
<script type="text/javascript" src="./JS/loginscript.js"></script>
</body>
</html>