<?php 
    session_start();
    require('actions/users/showUserAction.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/navbar.php'; ?>
        <div class="container">
            <?php
                if(isset($errormsg)) {
                    echo $errormsg;
                }

                if(isset($getUserQuestions)) {
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <h4>
                                    @<?= $userPseudo; ?>
                                </h4>     
                            </div>
                            <hr>
                            <p>
                                <?= $userLastName . ' ' . $userFirstName; ?>
                            </p>
                        </div>
                        <br>
                        <?php
                            while($question = $getUserQuestions->fetch()) {
                                ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <?= $question['title']; ?>
                                        </div>
                                        <div class="card-body">
                                            <?= $question['description']; ?>
                                        </div>
                                        <div class="card-footer">
                                            <?= $question['pseudo_author']; ?>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                            }
                        ?>
                    <?php
                }
            ?>
        </div>    
    </body>
</html>