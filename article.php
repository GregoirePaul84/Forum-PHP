<?php 
    session_start();
    require('actions/questions/showQuestionAction.php'); 
    require('actions/questions/publishCommentAction.php');
    require('actions/questions/showAllCommentsAction.php');
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/navbar.php'; ?>
        <br><br>

        <div class="container">

            <?php 
                if(isset($errormsg)) {
                    echo $errormsg;
                }

                if(isset($questionPublicationDate)) {
                    ?>
                        <section class="show-content">
                            <h3>
                                <?= $questionTitle; ?>
                            </h3>
                            <br>
                            <p>
                                <?= $questionContent; ?>
                            </p>
                            <br>
                            <small>
                                <?= '<a href="profile.php?id='.$questionIdAuthor.'">' .$questionPseudoAuthor . '</a> ' . $questionPublicationDate; ?>
                            </small>
                        </section>
                        <br>
                        <section class="show-comments">
                            <form class="form-group" method="POST" >
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Réponse</label>
                                    <textarea name="comments" class="form-control"></textarea>
                                    <br>
                                    <button class="btn btn-primary" type="submit" name="validate">Répondre</button>
                                </div>                                
                            </form>
                            <?php 
                                while($comments = $getAllCommentsOfThisQuestion->fetch()) {
                                    ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="profile.php?id=<?= $comments['id_author']; ?>">
                                                    <?= $comments['pseudo_author']; ?>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <?= $comments['content']; ?>
                                            </div>
                                        </div>
                                        <br>

                                    <?php
                                }
                            ?>
                        </section>
                        
                    <?php
                }
            ?>
        </div>

    </body>
</html>