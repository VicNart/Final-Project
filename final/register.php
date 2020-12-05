<?php
$servername ="localhost";
$username = "root";
$password = "8dCtHDCExA9N";
$dbname = "gd2022";

$link = mysqli_connect("$servername", "$username", "8dCtHDCExA9N", "$dbname");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['register'])) {
    $firstname = $_POST["fname"];
    $middlename =  $_POST["midname"];
    $lastname = $_POST["lname"];
    $email =  $_POST["email"];
    $password = md5($_POST["pass1"]);
    $confirmpass = md5($_POST["pass2"]);
    $gender = $_POST["gender"];

     
        if ($password == $confirmpass){
            
            $sql = "INSERT INTO signup(adminid, email, password, fname, mname, lname, gender) VALUES ('109092020', '$email', '$password','$firstname', '$middlename','$lastname', '$gender')";
            if(mysqli_query($link, $sql)){
                header('Location: login.php');
            } else{
                echo "ERROR: Could not execute $sql. " . mysqli_error($link);
            }
            
        }else{
            echo '<script>alert("Passwords do not match")</script>';
        }
}

// Close connection
mysqli_close($link);

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href ="register.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">

                        </ul>
                        <form method = "POST">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <h3 class="register-heading">Register</h3>
                                    <div class="row register-form">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="fname" class="form-control" placeholder="First Name" value="" />
                                            </div>

                                            
                                            <div class="form-group">
                                                <input type="text" name="lname" class="form-control" placeholder="Last Name" value="" />
                                            </div>
                                            <div class="form-group">
                                                <div class="maxl">
                                                    <label class="radio inline"> 
                                                        <input type="radio" name="gender" value="Male" checked>
                                                        <span> Male </span> 
                                                    </label>
                                                    <label class="radio inline"> 
                                                        <input type="radio" name="gender" value="Female">
                                                        <span>Female </span> 
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="phone" name="phone" pattern="[0-9][3]-[0-9][3]-[0-9][4]}"  class="form-control" placeholder="Your Phone Number eg.'023 456 7200'" value="" />
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" name="pass1"  class="form-control" placeholder="Password" value="" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="pass2"  class="form-control"  placeholder="Confirm Password" value="" />
                                                </div>

                                            </div>
                                    
                                            <input type="submit" class="btnRegister" name="register" onclick="location.href='signup.html'" value="Register"/>
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
        </div>
</div>
        