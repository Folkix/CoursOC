<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();


if (isset($_POST['prenom'])) {
    $_SESSION['prenom'] = $_POST['prenom'];
}

if (isset ($_SESSION['prenom']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Accueil</title>
    </head>
    <body>
    <p>
    Salut <?php echo $_SESSION['prenom']; ?> !<br />
    Tu es à l'accueil de mon site. Tu veux aller sur une autre page ?
    </p>
    <p>
        <a href="mapage.php">Lien vers votre espace perso</a><br />

    </p>
    </body>
    </html>
<?php
}

else
{

?>
    <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />
            <title>Connection</title>
        </head>
        <body>
        <p>
        Veuillez vous connecter :
        </p>

        <form method="post" action="superglobales.php">
        <p><label>Votre Prénom : <input type="text" name="prenom"/></label></p>
        <p><input type="submit" value="Valider"/></p>
        </form>

    </body>
    </html>
<?php
}

?>

