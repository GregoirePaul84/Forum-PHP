<?php
    require('actions/database.php');

    if(isset($_POST['validate'])){
        
        if(!empty($_POST['comments'])) {

            $userComment =  nl2br(htmlspecialchars($_POST['comments']));

            $insertComment = $database->prepare('INSERT INTO comments(id_author, pseudo_author, id_question, content) VALUES (?, ?, ?, ?)');
            $insertComment->execute(array($_SESSION['id'], $_SESSION['pseudo'], $_GET['id'], $userComment));
        }
    }