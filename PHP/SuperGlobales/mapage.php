<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

if (isset ($_SESSION['prenom']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Page perso</title>
    </head>
    <body>
    <p>
        Bienvenue sur votre page perso <?php echo $_SESSION['prenom']; ?> !<br />
        Ici il y a tes données personnel ! (c'est faux mais imagine putain...)
    </p>
    <p>
        <a href="superglobales.php">Lien vers l'accueil</a><br />

    </p>
    </body>
    </html>
    <?php
    session_destroy();
}

else
{

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Erreur de connection</title>
    </head>
    <body>
    <p>
        Erreur, veuillez retourner sur la page d'accueil pour vous connecter...<br />
    </p>

    <p>
        <a href="superglobales.php">Lien vers l'accueil</a><br />
    </p>

    </p>
    </body>
    </html>
    <?php
}

?>