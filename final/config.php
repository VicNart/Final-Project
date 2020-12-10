<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define("host","localhost");
define("db_name","von12672022");
define("username", "root");
define("password", getenv('MYSQLPASS') ? getenv('MYSQLPASS') : "");
 
class Database{
  
 
    // specify your own database credentials

    public $link;

  
   
    // get the database connection
    public function getConnection(){
 
        $this->link = null;
 
        try{
            $this->link = new PDO("mysql:host=" . constant('host') . ";dbname=" . constant('db_name'), constant('username'), constant('password'));
            $this->link->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->link;
    }
}
?>