<?php

$phrase = "Bonjour, je suis une phrase beaucoup trop longue samere";
$longueurValeur = strlen($phrase);

echo "<p>La phrase : <br/>" . $phrase . "<br/>contient $longueurValeur caractères.</p>";

$phraseMelange = str_shuffle($phrase);

echo "<p>Maintenant on la mélange : <br/> $phraseMelange</p>";
echo "<p>Ah, et en fait on est le : " . date('d') . "/" . date('m') . "/" . date('Y') . " et il est " . date('H') . ":" . date('i') . " Heure";

$prenoms = array("Guillaume", "Maxime");

function Saluer($prenom)
{
    foreach ($prenom as $prenoms)
    {
        echo "<p>Bonjour " . $prenoms . "</p>";
    }
}

Saluer($prenoms);