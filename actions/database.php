<?php

// Récupération de la base de données forum
try{
    // Vérifie la présence d'un identifiant de session à chaque changement de page
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $database = new PDO('mysql:host=localhost;port=8889;dbname=forum;charset=utf8', 'root', 'root');
}
catch(Exception $e) {
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
