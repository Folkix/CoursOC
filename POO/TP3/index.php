<?php
require 'lib/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($db);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil du site</title>
    <meta charset="utf-8" />
</head>

<body>
    <p><a href="admin.php">Accéder à l'espace d'administration</a></p>
    <?php
    if (isset($_GET['id']))
    {
        $news = $manager->getUnique((int) $_GET['id']);

        echo '<p>Par <em>' . $news->getAuteur() . '</em>, le ' . $news->getDateAjout()->format('d/m/Y à H\hi') . '</p>' . "\n" .
        '<h2>'. $news->getTitre() . '</h2>' . "\n" .
        '<p>' . $news->getContenu() . '</p>' . "\n";

        if ($news->getDateAjout() != $news->getDateModif())
        {
            echo '<p style="texte-align: right;"><small><em>Modifiée le ' . $news->getDateModif()->format('d/m/Y à H\hi') . '</em></small></p>';
        }
    }

    else
    {
        echo '<h2 style="text-align:center">Liste des 5 dernières news</h2>';

        foreach ($manager->getList(0, 5) as $news)
        {
            if (strlen($news->getContenu()) <= 200)
            {
                $contenu = $news->getContenu();
            }

            else
            {
               $debut = substr($news->getContenu(), 0, 200);
               $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

               $contenu = $debut;
            }

            echo '<h4><a href="?id=' . $news->getId() . '">' . $news->getTitre() . '</a></h4>' .
                '<p>' . $contenu . '</p>';
        }
    }
    ?>



</body>


