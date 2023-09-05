<?php

require('actions/database.php');

// Vérifie le formulaire
if(isset($_POST['validate'])) {

    // Vérifie la complétion des inputs
    if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['content'])) {

        // Nouvelles données
        $newQuestionTitle = htmlspecialchars($_POST['title']);
        $newQuestionDescription = nl2br(htmlspecialchars($_POST['description']));
        $newQuestionContent = nl2br(htmlspecialchars($_POST['content']));

        // Modifie les infos de la question comprenant l'id en paramètre
        $editQuestionOnWebsite = $database->prepare('UPDATE questions SET title = ?, description = ?, content = ? WHERE id = ?');
        $editQuestionOnWebsite->execute(array($newQuestionTitle, $newQuestionDescription, $newQuestionContent, $idOfQuestion));

        header('Location: myQuestions.php');

    } else {
        $errormsg = 'Veuillez compléter tous les champs';
    }
}

?>