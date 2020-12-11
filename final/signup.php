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
$errorEmail = "Email is not available";
 
// set user property values
$user->fname = $_POST['fname'];
$user->lname = $_POST['lname'];
$user->phone = $_POST['phone'];
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$user->cpassword = base64_encode($_POST['confirmpassword']);
$user->role = "1";

 
// create the user
if($user->signup()){
    header("Location:loginPage.php");
    }
else{
    if($user->errPass){
        $_SESSION["error"] = $errorPassword;
        header("location: register.php");
    }
    if($user->errEmail){
        $_SESSION["error"] = $errorEmail;
        header("location: register.php");
    }
}

print_r(json_encode($user_arr));
?>