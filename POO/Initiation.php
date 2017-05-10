<?php
function chargerClasse($classe)
{
    require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$perso1 = new Personnagetuto('Folkix', 80, 30);
$perso2 = new Personnagetuto('Jean-Paul', 30, 5);


echo 'Un ennemi approche ! Le personnage 1 attaque !<br>';
$perso1->frapper($perso2);
$perso1->gagnerExperience();
echo 'Le personnage 1 a maintenant ', $perso1->experience(), ' points d\'XP.<br>';
echo 'Le personnage 2 contre-attaque !<br>';
$perso2->frapper($perso1);
$perso2->gagnerExperience();
echo 'Le personnage 2 a maintenant ', $perso2->experience(), ' points d\'XP.<br>';
echo 'Le personnage 1 remets ça ! <br>';
$perso1->frapper($perso2);
$perso1->gagnerExperience();
echo 'Le personnage 1 a maintenant ', $perso1->experience(), ' points d\'XP.<br>';
echo 'Le personnage 2 retente le coup !<br>';
$perso2->frapper($perso1);
$perso2->gagnerExperience();
echo 'Le personnage 2 a maintenant ', $perso2->experience(), ' points d\'XP.<br>';
$perso1->afficherDegats();
$perso2->afficherDegats();
