<?php
    require('actions/database.php');

    $user_id = $_SESSION['id'];
    
    $getAllMyQuestions = $database->prepare('SELECT id, title, description FROM questions WHERE id_author = ?');
    $getAllMyQuestions->execute(array($user_id));

?>