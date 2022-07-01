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
    </style>

</head>
<body>
 <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="signup-form shadow">
                <form class="mt-5 border p-4 " method="POST">
                    <h4 class="mb-5 text-secondary">Create Your Account</h4>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>First Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label>Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name">
                        </div>
                         <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Address<span class="text-danger">*</span></label>
                            <input type="text" name="Address" class="form-control" placeholder="Enter Email">
                        </div>
                          <div class="radio-input d-flex">
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
	                          <label class="form-check-label" for="flexRadioDefault1">
	                            Customer
	                          </label>
	                        </div>
	                        <div class="form-check pl-3">
	                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
	                          <label class="form-check-label" for="flexRadioDefault2">
	                            Seller
	                          </label>
	                        </div>
	                    </div>
                        <div class="mb-3 col-md-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password"  class="form-control" name="pass" placeholder="Enter Password">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" name="pass" class="form-control"  placeholder="Confirm Password">
                        </div>
                        <div class="col-md-12">
                           <button class="btn btn-primary" name="signup-submit" class="signup-submit-button">Signup</button>
                               
                        </div>
                    </div>
                </form>
                <p class="text-center mt-3 text-secondary">If you have account, Please <a href="login.php">Login Now</a></p>
            </div>
        </div>
    </div>
</div>

<?php
	 if(isset($_POST['submit'])){
			$FirstName=$_POST["name"];
			$LastName=$_POST["lastname"];
			$email=$_POST["email"];
			$phone=$_POST["tel_num"];
			$Address=$_POST["Address"];
			$pas=$_POST["pass"];
			$category=$_POST["flexRadioDefault"].value;
			$SQL = "INSERT INTO Customer (Firstname,Lastname,Email,phone,address,password,category) VALUES ('". $FirstName ."','". $LastName ."','". $email ."',". $phone .",'". $Address ."','". $pas ."','". $category ."')";
			$result = mysqli_query($connection,$SQL);
		}
?>

</body>
</html>