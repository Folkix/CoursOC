<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=tpoc;charset=utf8', 'root', '');
//Un grand if pour ne rien faire au cas où aucune données n'a pas été transmise (j'aurais pu ajouté un message d'erreur mais j'ai pas trop réfléchis à comment
if (!empty($_POST['pseudo']) AND (!empty($_POST['message']))) {
    $req = $bdd->prepare("INSERT INTO chat(date_message, nom, message) VALUES (NOW(), :nom, :message)");

    $req->execute(array(
        'nom' => $_POST['pseudo'],
        'message' => $_POST['message'],
    ));
//Envoi du pseudo à la session pour le retenir
    $_SESSION['pseudo_session'] = $_POST['pseudo'];
}


    header('Location: mini_chat.php');
?>



