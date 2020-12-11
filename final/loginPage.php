<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="signin.css" rel="stylesheet" type="text/css"> 
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    
<div class="container login-container">
    <div class="row">
        <div class="col-md-6 login-form-2">
            <h3>Login</h3>
            
            <form action="login.php" method ="POST">
                
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Your Email" value="" />
                </div>
                <div class="form-group">
                    <input type="" class="form-control" name="password" placeholder="Your Password" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name="login" class="btnSubmit"  value="Login" />
                </div>
                <div class="form-group">
                    <span id="span1">Don't have an account?</span>
                    <a href="register.php" id = "SignUp" class="SignUp" value="Signup">Sign Up</a>
                </div>
                <div class="form-group">
                    <span id="span1">Admin Login</span>
                    <a href="adminlogin.php" id = "LogIn" class="LogIn" value="LogIn">here</a>
                </div>
                <div class="form-group">
                    <span><a href="index.html" id = "Home" class="Home" value="Home">Home</a></span>
                </div>
            </form>
        </div>
        
    </div>
    </form>
</div>
</body>
</html>

<?php
    unset($_SESSION["error"]);
?>
