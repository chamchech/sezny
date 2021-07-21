<?php
session_start();
include '../db.php';
if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    
    $stmt = $sql->prepare("SELECT * from vendeurs where username=?");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>0){
        $msg = "<div class='alert alert-danger'>Cet identifiant existe déjà. Veuillez en essayer un autre.</div>";
    }else{
        $stmt = $sql->prepare("INSERT INTO vendeurs (firstname, lastname, address, city, postcode, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
        $stmt->bindParam(1, $firstname, PDO::PARAM_STR);
        $stmt->bindParam(2, $lastname, PDO::PARAM_STR);
        $stmt->bindParam(3, $address, PDO::PARAM_STR);
        $stmt->bindParam(4, $city, PDO::PARAM_STR);
        $stmt->bindParam(5, $postcode, PDO::PARAM_STR);
        $stmt->bindParam(6, $email, PDO::PARAM_STR);
        $stmt->bindParam(7, $username, PDO::PARAM_STR);
        $stmt->bindParam(8, $password, PDO::PARAM_STR);
        $stmt->execute();
        $msg = "<div class='alert alert-success'>Commercial ajouter avec succès.</div>";
    }
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

    <title>Ajouter un commercial - Abonnement Juridique MEPERY</title>

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
        <?php if(isset($msg)){ echo $msg; } ?>
        <section class="jumbotron text-center" style="padding:20px">
            <div class="container">
                <h1 class="jumbotron-heading">Ajouter un commercial</h1>
                <a href="index.php"><svg class="bi bi-arrow-bar-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 00-.708 0l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708-.708L3.207 8l2.647-2.646a.5.5 0 000-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M10 8a.5.5 0 00-.5-.5H3a.5.5 0 000 1h6.5A.5.5 0 0010 8zm2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg> Retour</a>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Nom</label>
                                <input required class="form-control" name="firstname" type="text">
                            </div>
                            <div class="form-group">
                                <label>Prénom</label>
                                <input required class="form-control" name="lastname" type="text">
                            </div>
                            <div class="form-group">
                                <label>Code Postal</label>
                                <input required class="form-control" name="postcode" type="text">
                            </div>
                            <div class="form-group">
                                <label>Ville</label>
                                <input required class="form-control" name="city" type="text">
                            </div>
                            <div class="form-group">
                                <label>Adresse</label>
                                <input required class="form-control" name="address" type="text">
                            </div>
                            
                            <div class="form-group">
                                <label>Identifiant</label>
                                <input required class="form-control" name="username" type="text">
                            </div>
                            <div class="form-group">
                                <label>Adresse email</label>
                                <input required class="form-control" name="email" type="email">
                            </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input required class="form-control" name="password" type="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" name="submit">Valider</button>
                            </div>
                        </form>

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