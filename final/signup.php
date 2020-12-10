<?php
 
// get database connection
include_once("config.php");
 
// instantiate user object
include_once("customer.php");
 
session_start();
$database = new Database();
$db = $database-> getConnection();
 
$user = new customer($db);
$errorPassword = "Passwords do not match";
$errorUsername = "Username is not available";
$errorEmail = "Email is not available";
 
// set user property values
$user->Fname = $_POST['fname'];
$user->Lname = $_POST['lname'];
$user->Phone = $_POST['phone'];
$user->email = $_POST['email'];
$user->pass1 = base64_encode($_POST['pass1']);
$user->cpass2 = base64_encode($_POST['pass2']);
$user->role = "1";

 
// create the user
if($user->signup()){
    header("Location:index.php");
    }
else{
    if($user->errPass){
        $_SESSION["error"] = $errorPassword;
        header("location: register.php");
    }
    if($user->errUser){
        $_SESSION["error"] = $errorUsername;
        header("location: register.php");
    }
    if($user->errEmail){
        $_SESSION["error"] = $errorEmail;
        header("location: register.php");
    }
}


?>