<?php
require "CompteBancaire.php";
require "CompteEpargne.php";

$compteJean = new CompteBancaire("euros", 150, "Jean");
echo $compteJean . "<br/>";
$compteJean->crediter(100);
echo $compteJean . "<br/>";
echo "<br/>";

$comptePaul = new CompteEpargne("dollars", 200, "Paul", 0.05);
echo $comptePaul . "<br/>";
echo "Interets pour ce compte : " . $comptePaul->calculerInteret() . " " . $comptePaul->getDevise() . "<br/>";
$comptePaul ->calculerInteret(true);
echo $comptePaul . "<br/>";
echo "<br/>";

$compteFolkix = new CompteEpargne("euros", 6000, "Folkix", 0.075);
echo $compteFolkix . "<br/>";
echo "Interets pour ce compte : " . $compteFolkix->calculerInteret() . " " . $compteFolkix->getDevise() . "<br/>";
$compteFolkix ->calculerInteret(true);
echo $compteFolkix . "<br/>";
echo "<br/>";

