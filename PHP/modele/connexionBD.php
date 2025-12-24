<?php

class ConnectionBD{

private $pdo;

    public function __construct(){
     try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", 'root', '');
    } catch (Exception $e) {
         die("Erreur de connexion : " . $e->getMessage());
     }
}

public PDO getConnection(){
    return $this->pdo;
}
}