<?php

require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])){

    // Contrôle la bonne complétion des inputs
    if(!empty($_POST['pseudo'] && $_POST['lastname'] && $_POST['firstname'] && $_POST['password'])) {

        // Données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Interroge la DB pour vérifier si le pseudo est déjà présent
        $checkIfUserAlreadyExists = $database->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        // Si l'utilisateur n'existe pas encore
        if($checkIfUserAlreadyExists->rowcount() == 0) {
            $insertUserOnWebsite = $database->prepare('INSERT INTO users(pseudo, lastname, firstname, mdp) VALUES(?, ?, ?, ?)');
            $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));

            // Récupération des informations + l'id incrémenté du nouvel utilisateur
            $getInfosOfThisUserReq = $database->prepare('SELECT id, pseudo, lastname, firstname FROM users WHERE lastname = ? AND firstname = ? AND pseudo = ?');
            $getInfosOfThisUserReq->execute(array($user_lastname, $user_firstname, $user_pseudo));

            $userInfos = $getInfosOfThisUserReq->fetch();

            // Authentification de l'utilisateur
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userInfos['id'];
            $_SESSION['pseudo'] = $userInfos['pseudo'];
            $_SESSION['lastname'] = $userInfos['lastname'];
            $_SESSION['firstname'] = $userInfos['firstname'];

            // Redirection de l'utilisateur vers la page d'accueil
            header('Location: index.php');

        // Si l'utilisateur existe déjà
        } else {
            $errormsg = 'l\'utilisateur existe déjà sur le site';
        }

    } else {
        $errormsg = 'Veuillez compléter tous les champs';
    }
}

?>