<?php
$bdd = new PDO('mysql:host=localhost;dbname=tpoc;charset=utf8', 'root', '');
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8" />
    <title>Commentaires</title>
</head>
<body>
    <h1>Mon super Blog !</h1><br /><br />
    <a href="index.php">Retour à l'accueil</a><br />
    <?php
    $req = $bdd->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, \' %d/%m /%Y à %Hh %imin %ss\') AS date_creation_fr FROM billets WHERE id= ? ');
    $req->execute(array($_GET['billet']));

    while ($donnee = $req->fetch())
    {
        ?>
        <div class="news">
            <h3> <?php echo htmlspecialchars($donnee['titre'])?><em> Le <?php echo htmlspecialchars($donnee['date_creation_fr'])?></em></h3>
            <p> <?php echo htmlspecialchars($donnee['contenu'])?><br /></p>
        </div>
<?php
$req->closeCursor();
}
?>
<h2>Commentaires :</h2><br />
<?php
$req2 = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \' %d/%m /%Y à %Hh %imin %ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ');
$req2->execute(array($_GET['billet']));
    while ($donnee = $req2->fetch())
    {
?>
    <div>
        <b> <?php echo htmlspecialchars($donnee['auteur'])?></b><em> le <?php echo htmlspecialchars($donnee['date_commentaire_fr'])?></em><br />
        <p> <?php echo htmlspecialchars($donnee['commentaire'])?><br /></p>
    </div>
<?php
}
$req2->closeCursor();
?>


</body>

</html>