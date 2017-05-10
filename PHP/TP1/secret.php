<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Page des secrets</title>
</head>

<body>

<?php
    if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] == 'kangourou')
    {
        echo "<h1><strong>Vous avez maintenant accès aux secrets... Mais on les a égarer... Dommage...</strong></h1>";
    }

    else
    {
        echo "<h1><strong>ERROR ERROR VOTRE PC VA S'AUTO-DETRUIRE !</strong></h1>";
    }

?>


</body>

</html>