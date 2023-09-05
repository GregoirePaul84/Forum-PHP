<?php

// Récupération de la base de données forum
try{
    $database = new PDO('mysql:host=localhost;port=8889;dbname=forum;charset=utf8', 'root', 'root');
}
catch(Exception $e) {
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
