<?php
    session_start();
    // Vérifie si l'utilisateur est bien authentifié
    if(!isset($_SESSION['auth'])) {
        header('Location: ../../login.php');
    }

    require('../database.php');

    if(isset($_GET['id']) AND !empty($_GET['id'])){
        
        $idOfTheQuestion = $_GET['id'];
        $checkIfQuestionExists = $database->prepare('SELECT id_author FROM questions WHERE id = ?');
        $checkIfQuestionExists->execute(array($idOfTheQuestion));

        if($checkIfQuestionExists->rowCount() > 0) {

            $userInfos = $checkIfQuestionExists->fetch();

            if($userInfos['id_author'] == $_SESSION['id']) {
                $deleteQuestion = $database->prepare('DELETE FROM questions WHERE id = ?');
                $deleteQuestion->execute(array($idOfTheQuestion));

                header('Location: ../../myQuestions.php');
                
            } else {
                echo 'Vous n\'avez pas le droit de supprimer cette question';
            }
            
        } else {
            echo 'Aucune question n\'a été trouvée';
        }

    }else{
        echo 'Aucune question n\'a été trouvée';
    }

?>