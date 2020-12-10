<?php
class customer{
    // database connection and table name
    private $link;
    private $table_name = "customer";

    // object properties
    public $CUSTOMER_ID;
    public $login;
    public $Fname;
    public $Lname;
    public $email;
    public $Phone;
    public $pass1;
    public $cpass2;
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
        if ($this->pass1 != $this->cpass2){
            $this->errPass = true;
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    fname=:fname, lname=:lname,  phone=:phone, email=:email, role=:role, password=:pass1";

        // prepare query
        $stmt = $this->link->prepare($query);

        // sanitize
        $this->Fname=htmlspecialchars(strip_tags($this->Fname));
        $this->Lname=htmlspecialchars(strip_tags($this->Fname));
        $this->Phone=htmlspecialchars(strip_tags($this->Phone));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->pass1=htmlspecialchars(strip_tags($this->pass1));
       

        // bind values
        $stmt->bindParam(":fname", $this->Fname);
        $stmt->bindParam(":lname", $this->Lname);
        $stmt->bindParam(":phone", $this->Phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":pass1", $this->pass1);
       

        // execute query
        /*if($stmt->execute()){
            $this->CUSTOMER_ID = $this->link->lastInsertId();
            return true;
        }else{
            return false;
        }*/
    }

    // login user
    function login(){
        //Select all Query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                WHERE
                    (email='".$this->login."') AND (pass1='".$this->pass1."')";
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