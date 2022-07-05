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
        .des-password{
            outline: none;
            border: none;
            width:80%;
            margin-left:0.3em;
        }
        .form-input-password{
             border-radius: 0.2em;
        }
    </style>

</head>
<body>
 <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="signup-form shadow">
                <form class="mt-5 border p-4 " method="POST" autocomplete="off" onsubmit="return vaildation()">
                    <h4 class="mb-5 text-secondary">Create Your Account</h4>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>First Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter First Name" id="firstName">
                            <span id="firsterror" class="text-danger fw-bold"></span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label>Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name" id="lastName" >
                             <span id="lasterror" class="text-danger fw-bold"></span>
                        </div>
                         <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" id="email" >
                             <span id="emailerror" class="text-danger fw-bold"></span>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Address<span class="text-danger">*</span></label>
                            <input type="text" name="Address" class="form-control" placeholder="Enter Address" id="address">
                            <span id="addresserror" class="text-danger fw-bold"></span>
                        </div>
                         <div class="mb-3 col-md-12">
	                       	<select name="option" style="width:8em;">
	                       	   <option value="Customer">Customer</option>
	                       	   <option value="Seller">Seller</option>
	                       	 </select>                    
	                    </div>
                        <div class="mb-3 col-md-12">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="tel_num" placeholder="Enter Phone" id="phone">
                            <span id="phoneerror" class="text-danger fw-bold"></span>
                        </div>
                        <!-- password  -->
                        <div class="col-md-12 mb-2">
                            <label>Password<span class="text-danger">*</span></label>
                            <div class="border d-flex justify-content-between align-items-center form-input-password">
                                <input type="password"  class="des-password w-80" name="pass" placeholder="Enter Password"  id="password" oninput="strengthChecker()">
                               <div class="px-2 py-2 mx-1" id="password-eye">
                                   <span class="fas fa-eye-slash d-none" id="hide-pass"></span>
                                   <span class="fas fa-eye" id="display-pass"></span>
                               </div>
                            </div>
                             <span id="passerror" class="text-danger fw-bold"></span>
                        </div>
                        <!-- Conform password -->
                        <div class="mb-3 col-md-12">
                           <label>Confirm Password<span class="text-danger">*</span></label>
                           <div class="border d-flex justify-content-between align-items-center form-input-password">
                               <input type="password" name="pass" id="conpass"  placeholder="Confirm Password" class="des-password">
                               <div class="px-2 py-2 mx-1" id="password-eye-confrom">
                                   <span class="fas fa-eye-slash d-none" id="hide-pass-confrom"></span>
                                   <span class="fas fa-eye" id="display-pass-confrom"></span>
                               </div>
                           </div>
                           <span id="confromerror" class="text-danger fw-bold"></span>
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
        
                $query = "SELECT 1 FROM customer WHERE Email = '$email'";
                $selectresult = mysqli_query($connection, "SELECT 1 FROM customer WHERE Email = '$email'");
                if(mysqli_num_rows($selectresult)>0){
                    $msg = 'email already exists';
                    echo($msg);
                }
                else{
                $SQL = "INSERT INTO customer (Firstname,Lastname,Email,phone,address,password,category) VALUES ('". $FirstName ."','". $LastName ."','". $email ."',". $phone .",'". $Address ."','". $pas ."','". $category ."')";
                $result = mysqli_query($connection,$SQL);
                                if($result){
                                        $newuserid=mysqli_insert_id($connection);
                                        $_SESSION['userid']=$newuserid;
                                        //Create folder for user
                                            if($category=="Seller"){
                                                mkdir('./Uploads/'.$newuserid,0777,true);
                                            }
                                            echo'
                                            <script>
                                              location.href="./index.php?success=true";
                                            </script>';   
                                }
                                else{
                                    echo'<script>
                                document.getElementById("alerts").innerHTML=`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 Error while creating account!
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;</script>
                            ';
                                }
                            }
                            
                    }

?>
<script type="text/javascript" src="./JS/loginscript.js"></script>
</body>
</html>