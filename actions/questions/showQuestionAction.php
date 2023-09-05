<?php
require('actions/database.php');

// Si l'id de la question est dans les paramètres de requête
if(isset($_GET['id']) && !empty($_GET['id'])) {

    // Vérifier si la question existe
    $checkIfQuestionExists = $database->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($_GET['id']));

    if($checkIfQuestionExists->rowCount() > 0) {

        // Récupère les données de la question
        $questionInfos = $checkIfQuestionExists->fetch();

        // Stocke les infos 
        $questionTitle = $questionInfos['title'];
        $questionDescription = $questionInfos['description'];
        $questionContent = $questionInfos['content'];
        $questionIdAuthor = $questionInfos['id_author'];
        $questionPseudoAuthor = $questionInfos['pseudo_author'];
        $questionPublicationDate = $questionInfos['publication_date'];

    }else {
        $errormsg = "Aucune question n'a été trouvée";
    }
} else {
    $errormsg = "Aucune question n'a été trouvée";
}
?>