<?php
session_start();
include 'db.php';
if(!isset($_SESSION['vendeur_id'])){
    header('location:connexion.php');
}
if(isset($_POST['valider'])){
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password!=$cpassword){
        $msg = "<div style='background:red;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>Erreur, les mots de passe ne correspondent pas.</div>";
    }elseif(strlen($password)<6){
        $msg = "<div style='background:red;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>Le mot de passe doit comporter 6 caractères.</div>";
    }else{
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $sql->prepare("UPDATE vendeurs set password=? where id=?"); 
        $stmt->bindParam(1, $password, PDO::PARAM_STR);
        $stmt->bindParam(2, $_SESSION['vendeur_id'], PDO::PARAM_STR);
        $stmt->execute();
        $msg = "<div style='background:green;color:white;border-color:red;border-radius:5px;padding:10px;margin-top:5px'>Mot de passe modifié</div>";
    }
    
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

    <title>Profil - Abonnement Juridique MEPERY</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>
<div id="page">
        <div id="bloc-principal">
        <?php include 'nav.php'; ?>
    <main role="main">
    <?php if(isset($msg)){ echo $msg; } ?>
        
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Profil</h1>
                <a href="accueil.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                                <p><b>Nom : </b><?php echo $result[0]['firstname'].' '.$result[0]['lastname'];?></p>
                                <p><b>Ville : </b> <?php echo $result[0]['postcode'].' '.$result[0]['city'];?></p>
                                <p><b>Email : </b><?php echo $result[0]['email']?></p>
                                <p><b>Identifiant : <?php echo $result[0]['username']?></p>
                                
                                <center><form method="POST"><input  href="#modal1" class="btn btn-primary js-modal" type="submit" name="download" value="Modifier son mot de passe"></form></center>
                                 <!-- Début pop up -->
            <aside id="modal1" class="modal" aria-hidden="true" role="dialog" style="display: none;">
                <div class="modal-wrapper js-modal-stop">
                    <button class="js-modal-close" style="float:right;background:#999999;"><i class="fas fa-times" style="width:50px;"></i></button><br><br>
                    <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form method="post" action="">
                            
                            <div class="form-group">
                                <label>Nouveau mot de passe</label>
                                <input class="form-control" name="password" type="password">
                            </div>
                            <div class="form-group">
                                <label>Confirmation mot de passe</label>
                                <input class="form-control" name="cpassword" type="password">
                                
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary" name="valider">Valider</button>
                            </div>
                        </form>

                    </div>





                </div>
                </div>
            </aside>
            <!-- Fin pop up -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<br><br>
        <div class="row justify-content-center">
                    <div class="col-md-6">
                       <div class="form-group">
                            <a href="tuto.php" class="btn btn-secondary btn-block bouton-accueil">
                            Tutoriel
                            </a>
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
    <script src="js/popup.js"></script>
</body>

</html>