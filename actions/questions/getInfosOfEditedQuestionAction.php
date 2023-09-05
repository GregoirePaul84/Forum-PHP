<?php

require('actions/database.php');

// Vérifie l'id de la question dans les paramètres de requête
if(isset($_GET['id']) AND !empty($_GET['id'])) {

    $idOfQuestion = $_GET['id'];

    // Vérifie si la question existe
    $checkIfQuestionExists = $database->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfQuestion));

    if($checkIfQuestionExists->rowcount() > 0) {

        // Récupère les données de la question
        $questionInfos = $checkIfQuestionExists->fetch();
        
        if($questionInfos['id_author'] == $_SESSION['id']) {

            $questionTitle = $questionInfos['title'];
            $questionDescription = $questionInfos['description'];
            $questionContent = $questionInfos['content'];

           $questionDescription = str_replace( '<br />', '', $questionDescription );
           $questionContent = str_replace( '<br />', '', $questionContent );

        } else {
            $errormsg = 'Vous n\'êtes pas l\'auteur de cette question';
        }

    } else {
        $errormsg = 'Aucune question n\'a été trouvée';
    }

} else {
    $errormsg = 'Aucune question n\'a été trouvée';
}