<?php
 

class connection{

private $host = '';
private $dbname = '';
private $username = '';
private $password ='';  

public $con = '';

function __construct(){

    $this->connect();   

}

function connect(){

    try{

        $this->con = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username, $this->password);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->con->exec('SET NAMES utf8');


    }catch(PDOException $e){

        echo 'Hoooppps there was an error while trying to connect to the database';
        //file_put_contents('connection.errors.txt', $e->getMessage().PHP_EOL,FILE_APPEND);
		echo $e->getMessage().PHP_EOL;

    }
}   
}


?>
