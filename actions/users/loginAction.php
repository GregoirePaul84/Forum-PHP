<?php

require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])){

    // Contrôle la bonne complétion des inputs
    if(!empty($_POST['pseudo'] && $_POST['password'])) {

        // Données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['password']);

        // Vérifier si l'utilisateur existe
        $checkIfUserExists = $database->prepare('SELECT * FROM users WHERE pseudo = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        if($checkIfUserExists->rowCount() > 0) {

            $userInfos = $checkIfUserExists->fetch();

            // Comparaison des mdp
            if(password_verify($user_password, $userInfos['mdp'])) {
                
                // Authentification de l'utilisateur
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['pseudo'] = $userInfos['pseudo'];
                $_SESSION['lastname'] = $userInfos['lastname'];
                $_SESSION['firstname'] = $userInfos['firstname'];

                header('Location: index.php');

            } else {
                $errormsg = 'Mot de passe incorrect';
            }

        } else {
            $errormsg = 'Utilisateur introuvable';
        }

    } else {
        $errormsg = 'Veuillez compléter tous les champs';
    }
}

?>