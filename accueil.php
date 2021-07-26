<?php
session_start();
include 'db.php';
if(!isset($_SESSION['vendeur_id'])){
    header("location:connexion.php");
}

$stmt1 = $sql->prepare("SELECT * FROM vendeurs where id = ?");
$stmt1->bindParam(1,$_SESSION['vendeur_id'],PDO::PARAM_INT);
$stmt1->execute();
$result = $stmt1->fetchAll();
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">

    <title>Commercial - Sezny</title>

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
        <section class="jumbotron text-center" style="padding:20px;background-color:#e9ecef;">
            <div class="container">
                <h1 class="jumbotron-heading">Espace commercial<br>Abonnement Juridique MEPERY</h1>
                <h2 style="font-size:18px;">Bonjour <?php echo $result[0]['firstname'].' '.$result[0]['lastname'];?> !</h2>
            </div>
        </section>
        <div class="album py-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="accompagnement-juridique.php" class="btn btn-dark btn-block bouton-accueil">
                            Nos accompagnements Juridique
                            </a>
                        </div>
                       <div class="form-group">
                            <a href="ajout-vente.php" class="btn btn-primary btn-block bouton-accueil">
                            Ajouter une vente
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="signature.php" class="btn btn-success btn-block bouton-accueil">
                                Signer une vente
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="ventes.php" class="btn btn-info btn-block bouton-accueil">
                                Mes ventes
                            </a>
                        </div>

                        <div class="form-group">
                            <a href="profil.php" class="btn btn-secondary btn-block bouton-accueil">
                               Profil
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/holder.min.js"></script>
</body>

</html>