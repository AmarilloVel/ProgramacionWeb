<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;


    public function __construct(){
        $this->host = "localhost";
        $this->user = "amarillo";
        $this->pass = "amarillo123";
        $this->db = "encuesta";
        $this->charset = "utf8mb4";

    }

    public function connect(){

        // $conex = mysqli_connect($host,$user,$pass,$db);
        // if(!$conex){
        //     echo(mysqli_error());
        // }
        // echo"We're in";



        try{
            $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];
                        //objeto que permite hacer consultas a la bd
            $pdo = new PDO($connection,$this->user,$this->pass,$options );
            //print_r("Connected: ");
            
            return $pdo;
        }catch(PDOException $e){
            print_r("Error connection: ".$e->getMessage()); 
        }
    }
}



?>