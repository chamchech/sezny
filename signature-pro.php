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
    <title>Signer une vente - SEZNY</title>
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
                <h1 class="jumbotron-heading">Signer une vente pro</h1>
            </div>
        </section>
        <div style="text-align:center">
        <input type="submit" class="btn btn-secondary" onClick='location.href="?signed=1"' style="margin:10px;margin-right:50px" name="Signed" value="Vente signée"></input>
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
                                    <th>Signé</th>
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
                         <div class='row justify-content-center'>
                            <a class='btn btn-primary' href='accueil.php' role='button'>Retour </a>
                            </div>
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