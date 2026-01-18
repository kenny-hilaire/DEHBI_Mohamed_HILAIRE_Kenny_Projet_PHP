<?php

class ConnectionBD{

private $pdo;

    public function __construct(){
     try {
        $this->pdo = new PDO("mysql:host=mysql-hilaire.alwaysdata.net;dbname=hilaire_projetphp;charset=utf8", 'hilaire', 'PhpProject2025*');
    } catch (Exception $e) {
         die("Erreur de connexion : " . $e->getMessage());
     }
}

public function getConnection() : PDO{
    return $this->pdo;
}
}