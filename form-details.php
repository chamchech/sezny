<?php
session_start();
require './app_config.php';
include 'db.php';
if(!isset($_SESSION['vendeur_id'])){
    header('location:connexion.php');
}

if(isset($_GET['id'])){
     $stmt = $sql->prepare("select * from ventes where id = ? AND vendeur_id = ?");
     $stmt->bindParam(1, $_GET['id'], PDO::PARAM_STR);
     $stmt->bindParam(2, $_SESSION['vendeur_id'], PDO::PARAM_STR);
     $stmt->execute();
     $data = $stmt->fetch();
}

if(isset($_POST["download"])){
    function CurlSendGetRequest($url,$headers){
        $ch = curl_init($url);
        $options = array(CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER=>TRUE);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);
        return $data;
        }
    $headers = array(
        "Authorization: Bearer $api_key",
        "Content-Type: application/json"
    );
    $resp=CurlSendGetRequest($api_url.$data['files']."/download?alt=media",$headers);
    header('Content-type: application/pdf');
    echo $resp;
}


?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">

    <title>Détails client - Abonnement Juridique MEPERY</title>

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
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Détails client</h1>
                <a href="ventes.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mb-4 box-shadow" style="width:100%">
                            <div class="card-body ">
                            <center>
                                <p><b>Date engagement : </b><?php echo $data['Date_vente']; ?></p>
                                <p><b>Engagement : </b><?php echo $data['drop1']; ?></p>
                                <p><b>Tarif : </b><?php echo $data['drop2']; ?></p>
                            </center>
                                <p><b>Raison Social : </b><?php echo $data['raisonsocial']; ?></p>
                                <p><b>RCS : </b><?php echo $data['rcs']; ?></p>
                                <p><b>Adresse : </b> <?php echo $data['adresse']; ?></p>
                                <p><b>Code Postal : </b><?php echo $data['cp']; ?></p>
                                <p><b>Ville : </b><?php echo $data['ville']; ?></p>
                                <p><b>Téléphone : </b><?php echo $data['tel']; ?></p>
                                <p><b>Email : </b><?php echo $data['email']; ?></p>
                                <p><b>BIC : </b><?php echo $data['bic']; ?></p>
                                <p><b>IBAN : </b><?php echo $data['iban']; ?></p>
                                
                                
                                <center><form method="POST"><input class="btn btn-primary" type="submit" name="download" value="Télécharger PDF"></form></center>
                            </div>
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