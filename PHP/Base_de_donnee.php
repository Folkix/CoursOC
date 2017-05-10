<?php

$bdd = new PDO('mysql:host=localhost;dbname=coursoc', 'root', '');
$reponse = $bdd->query('SELECT console, nom FROM jeux_video');
while ($donnee = $reponse->fetch())
{
    echo '<p>' . $donnee['nom'] . ' de la console : ' . $donnee['console'] . '</p>';
}

?>
