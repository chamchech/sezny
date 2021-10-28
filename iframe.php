<?php
session_start();
require_once './db.php';
require './app_config.php';

$smt=$sql->prepare("SELECT members FROM ventes WHERE vendeur_id = ? AND signed = 'non'");
$smt->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
$smt->execute();
$result = $smt->fetchAll();

$members=$result[$_GET["sign"]]["members"];
$x=$result[$_GET['sign']];

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">
    <title>Signer une vente - Sezny</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/album.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>

<?php
echo "<html>
      <iframe  height='100%' width = '100%' src='{$app_url}/procedure/sign?members={$members}'></iframe>
      </html>";
?>
<div class="album py-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <a href="accueil.php" class="btn btn-info btn-block bouton-accueil">
                        Retour accueil
                    </a>
                </div>



            </div>




        </div>
    </div>
</div><br><br>
<?php include 'footer.php'; ?>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/vendor/holder.min.js"></script>
</body>
</html>









