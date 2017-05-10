<?php
require 'lib/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($db);

if (isset($_GET['modifier']))
{
    $news = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
    $manager->delete((int) $_GET['supprimer']);
    $message = 'La News a bien été supprimée !';
}

if (isset($_POST['auteur'])) {
    $news = new News(
        [
            'auteur' => $_POST['auteur'],
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu']
        ]
    );

    if (isset($_POST['id'])) {
        $news->setId($_POST['id']);
    }

    if ($news->isValid()) {
        $manager->save($news);

        $message = $news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !';
    }
    else {
        $erreurs = $news->getErreurs();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administration</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="lib/style.css">
    </head>
    <body>
    <p><a href=".">Accéder à l'accueil du site</a></p>

    <form action="admin.php" method="post">
        <p style="text-align: center">
            <?php
            if (isset($message))
            {
                echo $message . '<br/>';
            }
            ?>

        <?php if (isset($erreurs) && in_array(News::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br/>'; ?>
        Auteur : <input type="text" name="auteur" value="<?php if (isset($news)) echo $news->getAuteur(); ?>"/><br/>

        <?php if (isset($erreurs) && in_array(News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br/>'; ?>
        Titre : <input type="text" name="titre" value="<?php if (isset($news)) echo $news->getTitre(); ?>" /><br/>

        <?php if (isset($erreurs) && in_array(News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br/>'; ?>
            Contenu :<br/><textarea rows="8" cols="60" name="contenu"><?php if (isset($news)) echo $news->getContenu();?></textarea><br/>
            <?php
            if (isset($news) && !$news->isNew())
            {
                ?>
            <input type="hidden" name="id" value="<?= $news->getId() ?>" />
            <input type="submit" value="Modifier" />
                <?php
            }
            else
            {
                ?>
            <input type="submit" value="Ajouter"/>
            <?php
            }
            ?>
        </p>
    </form>

    <p style="text-align: center">Il y a actuellement <?= $manager->count() ?> news. En voici la liste :</p>

    <table>
        <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php
        foreach ($manager->getList() as $news)
        {
            echo '<tr><td>' . $news->getAuteur() . '</td><td>' . $news->getTitre() . '</td><td>' . $news->getDateAjout()->format('d/m/Y à H\hi') .
            '</td><td>' . ($news->getDateAjout() == $news->getDateModif() ? '-' : $news->getDateModif()->format('d/m/Y à H\hi')) .
            '</td><td><a href="?modifier=' . $news->getId() . '">Modifier</a> | <a href="?supprimer=' . $news->getId() .'">Supprimer</a></td></tr>' . "\n";
        }
        ?>
    </table>


    </body>
</html>
