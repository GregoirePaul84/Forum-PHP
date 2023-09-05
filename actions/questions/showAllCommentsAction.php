<?php
    require('actions/database.php');

    $question_id = $_GET['id'];

    $getAllCommentsOfThisQuestion = $database->prepare('SELECT * FROM comments WHERE id_question = ? ORDER BY id DESC');
    $getAllCommentsOfThisQuestion->execute(array($question_id));

?>