<?php
class customer{
    // database connection and table name
    private $link;
    private $table_name = "customer";

    // object properties
    public $CUSTOMER_ID;
    public $login;
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $password;
    public $cpassword;
    public $role;
    public $errUser;
    public $errEmail;
    public $errPass;

    // constructor with $db as database connection
    public function __construct($db){
        $this->link = $db;
    }
    // signup user
    function signup(){

        /*if($this->userAlreadyExist()){
            $this->errUser = true;
            return false;
        }*/
        if($this->emailAlreadyExist()){
            $this->errEmail = true;
            return false;
        }
        if ($this->password != $this->cpassword){
            $this->errPass = true;
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                fname=:fname, lname=:lname, phone=:phone, email=:email, role=:role, password=:password";

        // prepare query
        $stmt = $this->link->prepare($query);

        // sanitize
        $this->fname=htmlspecialchars(strip_tags($this->fname));
        $this->lname=htmlspecialchars(strip_tags($this->lname));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->password=htmlspecialchars(strip_tags($this->password));
       

        // bind values
        $stmt->bindParam(":fname", $this->fname);
        $stmt->bindParam(":lname", $this->lname);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":password", $this->password);
       

        // execute query
        if($stmt->execute()){
            $this->CUSTOMER_ID = $this->link->lastInsertId();
            return true;
        }else{
            return false;
        }
    }

    // login user
    function login(){
        //Select all Query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                WHERE
                    (email='".$this->login."') AND (password='".$this->password."')";
        // prepare query statement
        $stmt = $this->link->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    
    function allusers(){
        //Select all Query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name;
        // prepare query statement
        $stmt = $this->link->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function countusers(){
        
    }

    //Validation Functions
    /*function userAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }*/
   
    function emailAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";
        // prepare query statement
        $stmt = $this->link->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
?>