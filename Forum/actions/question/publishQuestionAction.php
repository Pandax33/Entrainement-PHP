<?php

require('actions/database.php');

if(isset($_POST['validate'])){
    if(!empty($_POST['tittle']) AND !empty($_POST['description']) AND !empty($_POST['contenu'])){
        $questionTittle= htmlspecialchars($_POST['tittle']);
        $questionDescription= nl2br(htmlspecialchars($_POST['description']));
        $questionContenu= nl2br(htmlspecialchars($_POST['contenu']));
        $questionDate = date('d/m/y');
        $idAuteur = $_SESSION['id'];
        $questionPseudoAuthor = $_SESSION['pseudo'];

        $insertQuestion = $bdd->prepare('INSERT INTO question(titre, description, contenu, id_auteur,pseudo_auteur,date) VALUES ( ?,?,?,?,?,?)');
        $insertQuestion->execute(array($questionTittle, $questionDescription, $questionContenu, $idAuteur, $questionPseudoAuthor, $questionDate));

        $succesMsg = "Votre question a bien été publié";
    }else{
        $errorMsg = "Veillez completer tout les champs";
    }

}