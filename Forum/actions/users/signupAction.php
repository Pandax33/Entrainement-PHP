<?php

require('actions/database.php');

if(isset($_POST['validate'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['password'])){
        $userPseudo = htmlspecialchars($_POST['pseudo']);
        $userLastName = htmlspecialchars($_POST['lastname']);
        $userFirstname= htmlspecialchars($_POST['firstname']);
        $userPassword =password_hash($_POST['password'], PASSWORD_DEFAULT);

        $checkAlreadyExist= $bdd->prepare('SELECT pseudo from users WHERE pseudo = ?');
        $checkAlreadyExist->execute(array($userPseudo));

        if($checkAlreadyExist->rowCount() == 0){
            $insertUser=$bdd -> prepare("INSERT INTO users (pseudo, prenom,nom,mdp) VALUES (?,?,?,?)");
            $insertUser->execute(array($userPseudo,$userFirstname,$userLastName,$userPassword));

            $getInfosUserSQL = $bdd->prepare('Select id,pseudo,nom,prenom from users where nom = ? and prenom = ? and pseudo = ?');
            $getInfosUserSQL->execute(array($userLastName,$userFirstname,$userPseudo));

            $usersInfos = $getInfosUserSQL->fetch();

            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['pseudo'] = $usersInfos['pseudo'];
            $_SESSION['prenom'] = $usersInfos['prenom'];
            $_SESSION['nom'] = $usersInfos['nom'];
            header('Location: index.php');
            
        }else{
            $errorMsg = "L'utilisateur existe déjà";
        }

    }
    else{
        $errorMsg = 'Veuillez compléter tous les champs . . .';
    }
}
?>