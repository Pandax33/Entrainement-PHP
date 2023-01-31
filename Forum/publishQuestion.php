<?php 
    require('actions/question/publishQuestionAction.php');
    require('actions/users/securityAction.php'); ?>
<!DOCTYPE html>
<html lang="eu">
    <?php include 'includes/head.php'; ?>
    <body>
    <?php include 'includes/navbar.php'; ?>
    <br></br>
    <form class="container" method="POST">
    
        <?php if(isset($errorMsg)){ 
            echo '<p>'.$errorMsg.'</p>'; 
            }elseif (isset($succesMsg)) {echo '<p>'.$succesMsg.'</p>';
            } ?>


        <div class="mb-3">
            <label for="exampleInputEmail1">Titre</label>
            <input type="text" class="form-control" name="tittle">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1">Description</label>
            <textarea class="form-control" name="description" ></textarea>
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1">Contenu</label>
            <textarea class="form-control" name= "contenu"></textarea>
            
        </div>
       
        <button type="submit" class="btn btn-primary" name="validate">Publier la question</button>
        <br><br>

    </body>
</html>