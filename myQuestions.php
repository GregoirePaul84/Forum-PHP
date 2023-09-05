<?php 
    require('actions/users/securityAction.php'); 
    require('actions/questions/myQuestionsAction.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>

        <br><br>
        <div class="container">
            <?php 
                while($question = $getAllMyQuestions->fetch()) {
                    ?>
                        <div class="card">
                            <a href="article.php?id=<?= $question['id']; ?>">
                                <h5 class="card-header">
                                    <?= $question['title']; ?>
                                </h5>
                            </a>
                            <div class="card-body">
                                <p class="card-text">
                                    <?= $question['description']; ?>
                                </p>
                                <a href="article.php?id=<?= $question['id']; ?>" class="btn btn-primary">Accéder à la question</a>
                                <a href="editQuestion.php?id=<?= $question['id'] ?>" class="btn btn-warning">Modifier la question</a>
                                <a href="actions/questions/deleteQuestionAction.php?id=<?= $question['id'] ?>" class="btn btn-danger">Supprimer la question</a>
                            </div>
                        </div>
                        <br>
                    <?php
                }

            ?>
        </div>
        
    </body>
</html>