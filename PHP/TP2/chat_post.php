<?php
$bdd = new PDO('mysql:host=localhost;dbname=tpoc', 'root', '');
$req = $bdd->prepare("INSERT INTO chat(nom, message) VALUES (:nom, :message)");

$req->execute(array(
    'nom' => $_POST['pseudo'],
    'message' => $_POST['message'],
));



header('Location: chat.php');
?>



