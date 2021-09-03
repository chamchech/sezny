<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header('location:connexion.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">

    <title>Admin - Sezny</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">
</head>

<body>
<div id="page">
    <div id="bloc-principal">
        <?php include 'nav.php'; ?>
        <main role="main">
            <section class="jumbotron text-center" style="padding:50px;">
                <div class="container">
                    <h1 class="jumbotron-heading">Tableau d'administration SEZNY</h1>
                </div>
            </section>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 contBtn">
                            <div class="form-group">
                                <a href="ajout-commercial.php" class="btn btn-dark btn-block bouton-accueil addCom">
                                    Ajouter un nouveau commercial
                                </a>
                            </div>
                            <div class="form-group">
                                <a href="commerciaux.php" class="btn btn-dark btn-block bouton-accueil com">
                                    Nos commerciaux
                                </a>
                            </div>
                            <div class="form-group">
                                <a href="clients-pro.php" class="btn btn-dark btn-block bouton-accueil clientspro">
                                    Nos clients pro
                                </a>
                            </div>
                            <div class="form-group">
                                <a href="clients.php" class="btn btn-dark btn-block bouton-accueil clients">
                                    Nos clients
                                </a>
                            </div>

                            <div class="form-group">
                                <a href="profil.php" class="btn btn-dark btn-block bouton-accueil profil">
                                   Mon profil
                                </a>
                            </div>


                        </div>


                    </div>
                </div>
            </div>

        </main>
        <?php include 'footer.php'; ?>


    </div>

</div><!-- fin page -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/vendor/holder.min.js"></script>
</body>

</html>