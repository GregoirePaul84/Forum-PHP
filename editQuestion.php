<?php 
    require('actions/users/securityAction.php'); 
    require('actions/questions/getInfosOfEditedQuestionAction.php'); 
    require('actions/questions/editQuestionAction.php'); 
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
                    echo '<p>'.$errormsg.'</p>'; 
                }
            ?>
            <?php
                if(isset($questionContent)) {
                    ?>
                    <form class=container method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Titre de la question</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="title" 
                                value="<?= $questionTitle ?>"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Description de la question</label>
                            <textarea class="form-control" name="description"><?= $questionDescription ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contenu de la question</label>
                            <textarea type="text" class="form-control" name="content"><?= $questionContent ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="validate">Modifier</button>
                    </form>
                    <?php
                }
            ?>
        </div>
    </body>
</html>