<?php
require('actions/database.php');

if(isset($_POST['validate'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){
        $userPseudo = htmlspecialchars($_POST['pseudo']);
        $userPassword = htmlspecialchars($_POST['password']);
        $checkUserExist = $bdd->prepare('Select * from users where pseudo =?');
        $checkUserExist->execute(array($userPseudo));

        if($checkUserExist->rowCount() > 0){
            $usersInfos = $checkUserExist->fetch();
            if(password_verify($userPassword,$usersInfos['mdp'])){
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];
                $_SESSION['prenom'] = $usersInfos['prenom'];
                $_SESSION['nom'] = $usersInfos['nom'];
                header('Location: index.php');
            }
            else{
                $errorMsg = "Votre mot de passe n'est pas valide";
            }

        }else{
            $errorMsg = "Votre pseudo n'est pas valide";
        }
    }
    else{
        $errorMsg = 'Veuillez compléter tous les champs . . .';
    }

}
?>