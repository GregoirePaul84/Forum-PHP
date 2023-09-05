<?php
require('actions/database.php');

// Récupère les questions (max 5) par défaut sans la recherche
$getAllQuestions = $database->query('SELECT id, id_author, title, description, pseudo_author, publication_date FROM questions ORDER BY id DESC LIMIT 0,5');

// Vérifie la présence d'une recherche de l'utilisateur dans les paramètres de requête
if(isset($_GET['search']) AND !empty($_GET['search'])) {

    $userSearch = $_GET['search'];

    // Récupération des questions correspondants à la recherche (en fonction du titre)
    $getAllQuestions = $database->query('SELECT id, id_author, title, description, pseudo_author, publication_date FROM questions WHERE title LIKE "%'.$userSearch.'%" ORDER BY id DESC');
 

}

