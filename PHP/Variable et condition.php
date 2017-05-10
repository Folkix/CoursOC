<?php
$ageDuVisiteur = 20;

echo "Le visiteur à " . $ageDuVisiteur . " ans.";
echo "<br/><br/>";

if ($ageDuVisiteur < 12)
{
    echo "Ah ! t'es un gamin !";
    $autorisationEntrer = false;
}

elseif ($ageDuVisiteur > 12 AND $ageDuVisiteur <= 17)
{
    echo "T'es un ado prépubère.";
    $autorisationEntrer = false;
}

elseif ($ageDuVisiteur == 18)
{
    echo "Waw ! T'es tout pile majeur !";
    $autorisationEntrer = true;
}

elseif ($ageDuVisiteur > 18)
{
    echo "Tu es un adulte...";
    $autorisationEntrer = true;
}

echo "<br/>";

if ($autorisationEntrer)
{
    echo "<strong>T'a pas le droit d'être ici ! Casse-toi !</strong>";
}
elseif (!$autorisationEntrer)
{
    echo "<strong>Tu peux entrer, les pornos sont au fond...</strong>";
}