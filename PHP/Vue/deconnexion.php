<?php
session_start(); // On récupère la session en cours

// On vide toutes les variables de session
$_SESSION = array();

// On détruit physiquement la session côté serveur
session_destroy();

// On redirige vers la page de connexion
header("Location: Connexion.php");
exit();
?>