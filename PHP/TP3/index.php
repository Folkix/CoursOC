<?php
$bdd = new PDO('mysql:host=localhost;dbname=tpoc;charset=utf8', 'root', '');
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8" />
    <title>Index</title>
</head>
<h1>Mon super Blog !</h1><br /><br />
<p>Les dernières actualitées :</p><br />
<?php
$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \' %d/%m /%Y à %Hh %imin %ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
while ($donnee = $req->fetch())
{
?>
    <div class="news">
        <h3> <?php echo htmlspecialchars($donnee['titre'])?><em> Le <?php echo htmlspecialchars($donnee['date_creation_fr'])?></em></h3>
        <p> <?php echo htmlspecialchars($donnee['contenu'])?><br />
        <a href="commentaires.php?billet=<?php echo htmlspecialchars($donnee['id'])?>"> Commentaires</a></p><br />
    </div>
<?php
}
$req->closeCursor();
?>


</body>

</html>
