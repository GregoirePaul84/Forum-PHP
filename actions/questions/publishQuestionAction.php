<?php 

require('actions/database.php');

if(isset($_POST['validate'])) {
    
    if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['content'])) {

        $questionTitle = htmlspecialchars($_POST['title']);
        $questionDescription = nl2br(htmlspecialchars($_POST['description']));
        $questionContent = nl2br(htmlspecialchars($_POST['content']));
        $questionDate = date('d/m/Y');
        $questionIdAuthor = $_SESSION['id'];
        $questionPseudoAuthor = $_SESSION['pseudo'];

        $insertQuestionWebsite = $database->prepare('INSERT INTO questions(title, description, content, id_author, pseudo_author, publication_date) VALUES (?, ?, ?, ?, ?, ?)');
        $insertQuestionWebsite->execute(
            array(
                $questionTitle, 
                $questionDescription, 
                $questionContent, 
                $questionIdAuthor, 
                $questionPseudoAuthor, 
                $questionDate
            )
        );

        $successmsg = 'Votre question a bien été publiée !';

    } else {
        $errormsg = 'Veuillez compléter tous les champs';
    }
}


