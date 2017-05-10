<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <title>Ma page web</title>

</head>

<body>

<h1>Ma page web</h1>
<?php echo "Bonjour en PHP !"; ?>
<!-- Juste un message écrit. -->
<?php echo "<strong>Bonjour en PHP !</strong>"; ?>
<!-- Date dynamique -->
<p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>
<!-- Choix d'un nombre aléatoire -->
<p>Et je laisse le code php choisir un chiffre entre 1 et 10 : <?php echo rand(1, 10) ?></p>

</body>

</html>
