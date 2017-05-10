<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Bootstrap template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/test.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-1">1 col</div>
        <div class="col-lg-2">2 colonnes</div>
        <div class="col-lg-3">3 colonnes</div>
        <div class="col-lg-6">6 colonnes</div>
    </div>
    <div class="row">
        <div class="col-lg-12">12 colonnes</div>
    </div>
    <div class="row">
        <div class="col-lg-4">4 colonnes</div>
        <div class="col-lg-8">8 colonnes</div>
    </div>
    <div class="row">
        <div class="col-lg-3">3 colonnes</div>
        <div class="col-lg-6">6 colonnes</div>
        <div class="col-lg-3">3 colonnes</div>
    </div>
    <div class="row">
        <div class="col-lg-3">3 colonnes</div>
        <div class="col-lg-offset-6 col-lg-3">3 colonnes</div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-lg-offset-1">2 colonnes</div>
        <div class="col-lg-4 col-lg-offset-2">4 colonnes</div>
        <div class="col-lg-2 col-lg-offset-1">2 colonnes</div>
    </div>
    <div class="row">
        <div class="col-lg-8">8 colonnes
            <div class="row">
                <div class="col-lg-3">3 colonnes</div>
                <div class="col-lg-6">6 colonnes</div>
                <div class="col-lg-3">3 colonnes</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">Premier niveau avec 12 colonnes
            <div class="row">
                <div class="col-md-8">Second niveau avec 8 colonnes
                    <div class="row">
                        <div class="col-md-4">Troisième niveau avec 4 colonnes</div>
                        <div class="col-md-6 col-md-offset-2">Troisième niveau avec 6 colonnes
                            <div class="row">
                                <div class="col-md-3 col-md-offset-1">Quatrième niveau avec 3 colonnes</div>
                                <div class="col-md-5 col-md-offset-1">Quatrième niveau avec 5 colonnes</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">Second niveau avec 4 colonnes</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">12 colonnes
            <div class="row">
                <div class="col-lg-2 col-lg-push-8">Colonne 1</div>
                <div class="col-lg-2 col-lg-push-3">Colonne 2</div>
                <div class="col-lg-2 col-lg-pull-2">Colonne 3</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">6 colonnes
            <div class="row">
                <div class="col-lg-4">4 colonnes</div>
                <div class="col-lg-4 col-lg-offset-4">4 colonnes</div>
            </div>
        </div>
        <div class="col-lg-6">6 colonnes
            <div class="row">
                <div class="col-lg-4">4 colonnes</div>
                <div class="col-lg-8">8 colonnes</div>
            </div>
        </div>
    </div>
    <footer class="row">
        <div class="col-lg-12">
            Pied de page
        </div>
    </footer>

</div>
</body>
</html>