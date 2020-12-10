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
            
            <form method ="POST">
                
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" value="" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="manid" placeholder="Your ID number" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name="login_btn" class="btnSubmit" value="Login" />
                </div>
                <div class="form-group">
                    <span id="span1">Not an Admin signup as customer here:</span>
                    <a href="register.php" id = "SignUp" class="SignUp" value="Signup">Sign Up</a>
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

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "von12672022";

$link = mysqli_connect("$servername", "$username", "$password", "$dbname");
$mail = $_POST['email'];
$id = $_POST['manid'];
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



//selecting query
$sql = "Select * from manager where EMAIL ='$mail'";
$result = mysqli_query($link,$sql);



if ( !isset($mail, $id) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the email and password fields!');
}

if ($stmt = $link->prepare('SELECT MAN_ID, STAFF_ID FROM manager WHERE EMAIL = ?')) {
	// Bind parameters 
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($MAN_ID, $EMAIL);
        $stmt->fetch();
    
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        
        if (md5($_POST['email']) === $EMAIL){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['MAN_ID'] = $MAN_ID;

            //checking if user has loggged in before
            if(isset($result)){
                $n = mysqli_fetch_assoc($result);
                $firstname = $n['Fname'];
                $surname = $n['Lname'];
                if(!empty($firstname) && !empty($surname)){
                    header('Location:/AdminLTE-master/starter.html');
                }

                else{            
                    header('Location:adminlogin.php');
                }
            }
        }else{
            echo "Incorrect password";
        }
               
    }else{
        // Incorrect username
        echo '<script>alert("Incorrect username and/or password")</script>';
        
    }

    $stmt->close(); //close the connection
}


// Close connection
mysqli_close($link);

?>