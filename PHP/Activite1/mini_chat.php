<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=tpoc;charset=utf8', 'root', '');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="stylechat.css">
    <meta charset="utf-8" />
    <title>Chat</title>
</head>

<body>
<?php
//Si un pseudo à été retenu, le mettre dans l'input pseudo
if (isset($_SESSION['pseudo_session'])){
    ?>
<form class="chatFormulaire" method="post" action="mini_chat_post.php">
    <p><label>Pseudo <input type="text" name="pseudo" value="<?php echo $_SESSION['pseudo_session'] ?>"/></label><br />
    <label>Message <input type="text" name="message" autofocus/></label></p>
    <p><input type="submit" value="Valider"/></p>
</form>
<?php
}
//Peut être que je me complique la vie et que si le "$_session" était vide, la valeur aller être vide donc pas besoin de ce if, else...
else{?>
    <form class="chatFormulaire" method="post" action="mini_chat_post.php">
    <p><label>Pseudo <input type="text" name="pseudo"/></label><br />
    <label>Message <input type="text" name="message"/></label></p>
    <p><input type="submit" value="Valider"/></p>
    </form>
<?php
}

?>


<?php
//Affichage des commentaires
$message = $bdd->query('SELECT DATE_FORMAT(date_message, \'[%d/%m/%Y - %Hh %imin %ss]\') AS date_message_fr, nom, message FROM chat ORDER BY ID DESC LIMIT 0, 10');
while ($donnee = $message->fetch())
{
    echo '<p>' . htmlspecialchars($donnee['date_message_fr']) .  '<b> ' . htmlspecialchars($donnee['nom']) . '</b> : ' . htmlspecialchars($donnee['message']) . '</p>';
}

?>



</body>

</html>