<?php
$bdd = new PDO('mysql:host=localhost;dbname=tpoc', 'root', '');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Chat</title>
</head>

<body>
<?php
$message = $bdd->query('SELECT nom, message FROM chat ORDER BY ID DESC LIMIT 0, 10');
while ($donnee = $message->fetch())
{
    echo '<p>' . htmlspecialchars($donnee['nom']) . ' : ' . htmlspecialchars($donnee['message']) . '</p>';
}

?>
<form method="post" action="chat_post.php">
    <p><label>Pseudo <input type="text" name="pseudo"/></label></p>
    <p><label>Message <input type="text" name="message"/></label></p>
    <p><input type="submit" value="Valider"/></p>

</form>


</body>

</html>