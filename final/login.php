<?php
// include database and object files
include_once "config.php";
include_once "customer.php";


// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new customer($db);

//Error messages to be displayed is login credentials are not corrects
$errorlogin = "Incorrect Login credentials";

//Set variables
$user->login = isset($_POST['email']) ? $_POST['email'] : die('error');
$user->password = base64_encode(isset($_POST['password']) ? $_POST['password'] : die('error'));

$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    session_start();    
    $_SESSION['fname'] = $row['fname'];
    $_SESSION['CUSTOMER_ID'] = $row['CUSTOMER_ID'];
    $_SESSION['role'] = $row['role'];

    
    if($row['role'] == 1){
        header("Location: index.html");
    }
    if($row['role'] == 0){
        header('Location: post.html');
    }
    
}
else{
    session_start();
    $_SESSION["error"] = $errorlogin;
    header("location: products.html");
}

?>