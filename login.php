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
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="row g-3">
                        <h4>Login</h4>
                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
 <!--                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe"> Remember me</label>
                            </div>
                        </div> -->
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
</body>
</html>