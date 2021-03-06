<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once './db.php';
    $smt=$sql->prepare("SELECT nomcontact,prenomcontact,email,raisonsocial,signed FROM ventes WHERE vendeur_id = ? AND signed = 'non'");
    $smt->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
    $smt->execute();

    $smt1=$sql->prepare("SELECT nomcontact,prenomcontact,email,raisonsocial,signed FROM ventes WHERE vendeur_id = ? AND signed = 'oui'");
    $smt1->bindParam(1, $_SESSION['vendeur_id'], PDO::PARAM_INT);
    $smt1->execute();

    $result = $smt->fetchAll();
    $result1 = $smt1->fetchAll();
   ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="56x56" href="assets/img/favicon-96x96.png">
    <title>Signer une vente - Abonnement Juridique MEPERY</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/album.css" rel="stylesheet">
</head>
<body>
<div id="page">
        <div id="bloc-principal">
        <?php include 'nav.php'; ?>
    <main role="main">
        <?php if(isset($msg)){ echo $msg; } ?>
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Signer une vente</h1>
                <a href="accueil.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div style="text-align:center">
        <input type="submit" class="btn btn-secondary" onClick='location.href="?signed=1"' style="margin:10px;margin-right:50px" name="Signed" value="Vente sign??e"></input>
        <input type="submit" class="btn btn-secondary" onClick='location.href="?unsigned=1"' style="margin:10px;margin-left:50px" name="Unsigned" value="En attente de signature"></input>
        </div>
        <?php if(!isset($_POST["button1"])){echo
        "<div class='album py-5 bg-light'>
            <div class='container'>
                <div class='row justify-content-center'>
                    <div class='col-md-12'>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                <th>Raison Social</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Sign??</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                                
                                    
                                
                                if(isset($_GET['signed'])){
                                    foreach($result1 as $key=>$row){
                                        echo "<tr>
                                        <td>{$row['raisonsocial']}</td>
                                        <td>{$row['nomcontact']} {$row['prenomcontact']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['signed']}</td>
                                            <td></td>
                                         </tr>";
                                         }
                                }
                                else if(isset($_GET['unsigned']) || isset($_GET)){
                                    foreach($result as $key=>$row){
                                        echo "<tr>
                                        <td>{$row['raisonsocial']}</td>
                                        <td>{$row['nomcontact']} {$row['prenomcontact']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['signed']}</td>
                                            <td>

                                            <a class='btn btn-success btn-sm' name='sign' href='iframe.php?sign=";
            echo $key . "'";

            echo ">Signer</a>
                                             </td>
                                         </tr>";
                                         }
                                }
                                echo "
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>";} ?>
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