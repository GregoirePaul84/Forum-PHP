<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // Vérifie si l'utilisateur est bien authentifié
    if(!isset($_SESSION['auth'])) {
        header('Location: ../../login.php');
    }

    require('../database.php');

    // Vérifie si l'id est présent dans les paramètres de requête
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        
        $idOfTheQuestion = $_GET['id'];

        // Vérifie si la question existe
        $checkIfQuestionExists = $database->prepare('SELECT id_author FROM questions WHERE id = ?');
        $checkIfQuestionExists->execute(array($idOfTheQuestion));

        if($checkIfQuestionExists->rowCount() > 0) {

            // Récupère les infos de la question
            $userInfos = $checkIfQuestionExists->fetch();

            // Contrôle que l'id de l'auteur est bien celui de la session
            if($userInfos['id_author'] == $_SESSION['id']) {

                // Supprime la question
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