<?php 
    require('actions/database.php');

    // Récupère l'id de l'utilisateur
    if(isset($_GET['id']) && !empty($_GET['id'])) {

        $userId = $_GET['id'];

        // Vérifie si l'utilisateur existe
        $checkIfUserExists = $database->prepare('SELECT * FROM users WHERE id = ?');
        $checkIfUserExists->execute(array($userId));

        if($checkIfUserExists->rowCount() > 0) {

            // Récupération des données de l'utilisateur
            $userInfos = $checkIfUserExists->fetch();

            $userPseudo = $userInfos['pseudo'];
            $userLastName = $userInfos['lastname'];
            $userFirstName = $userInfos['firstname'];

            // Récupérer toutes les questions publiées par l'utilisateur
            $getUserQuestions = $database->prepare('SELECT * FROM questions WHERE id_author = ? ORDER BY id DESC');
            $getUserQuestions->execute(array($userId));

        } else {
            $errormsg = "Aucun utilisateur trouvé";
        }

    } else {
        $erromsg = "Aucun utilisateur trouvé";
    }