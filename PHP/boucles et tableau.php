<?php

$repetition = 1;

while ($repetition <= 10)
{
    echo "<p>Je répète beaucoup de choses, j'en suis fier ! " . $repetition . "</p>";
    $repetition++;
}

$prenoms = array("Guillaume", "Maxime", "Jean-Paul");

echo '<h2><strong><u>Voici la liste des prenoms contenu dans la variable "$prenoms" :</u></strong></h2> ';

foreach ($prenoms as $prenom)
{
    echo "<p><strong>" . $prenom . "</strong></p>";
}